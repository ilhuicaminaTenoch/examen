<template>
    <div class="container">
        <h2>Conexión con GitHuib</h2>
        <div class="panel panel-default">
            <div class="row">
                <div class="col-md-6">
                    <h3>Formulario</h3>
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Título (*)</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese Título">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Descripción (*)</label>
                            <div class="col-md-9">
                                <textarea v-model="descripcion" class="form-control"
                                          placeholder="Ingrese Descripcion"></textarea>

                            </div>
                        </div>

                        <div v-show="errorGit">
                            <div v-for="error in errorMostrarMensajeGit" class="alert alert-danger">
                                <strong v-text="error"></strong>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary" @click="enviar()">Enviar</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h3>Listado de issue</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Descripción</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="issue in arrayRespuesta" :key="issue.id">
                            <th scope="row" v-text="issue.id"></th>
                            <td v-text="issue.title"></td>
                            <td v-text="issue.body"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    export default {
        data() {
            return {
                nombre: '',
                descripcion: '',
                arrayRespuesta: [],
                errorGit: 0,
                errorMostrarMensajeGit: [],
            }
        },
        methods: {
            enviar() {
                let me = this;

                if (this.validar()) {
                    return;
                }

                axios.post('/enviar', {
                    'titulo': me.nombre,
                    'descripcion': me.descripcion
                }).then(function (response) {
                    me.arrayRespuesta = response.data.issue;
                    me.listarIssues();
                    me.nombre = '';
                    me.descripcion = '';
                }).catch(function (error) {
                    console.log(error);
                });
            },
            listarIssues() {
                let me = this;
                var url = '/listar-issue';
                axios.get(url).then(function (response) {
                    me.arrayRespuesta = response.data.issue;
                }).catch(function (error) {
                    console.log(error);
                });

            },
            validar() {
                this.errorGit = 0;
                this.errorMostrarMensajeGit = [];

                if (!this.nombre) this.errorMostrarMensajeGit.push("El Titulo no puede estar vacio");
                if (!this.descripcion) this.errorMostrarMensajeGit.push("La Descripcion no puede estar vacia.");

                if (this.errorMostrarMensajeGit.length) this.errorGit = 1;

                return this.errorGit;
            },
        },
        mounted() {
            this.listarIssues();
        }

    }
</script>
