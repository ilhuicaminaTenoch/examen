<template>

    <div class="row">
        <div class="col-md-6">
            <h3>Formulario</h3>
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Titulo</label>
                    <div class="col-md-9">
                        <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese Titulo">

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="email-input">Descripcion</label>
                    <div class="col-md-9">
                        <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese Descripcion">
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" @click="enviar()">Enviar</button>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Respuesta</h3>
            <pre>{{ arrayRespuesta }}</pre>
        </div>
    </div>


</template>

<script>
    export default {
        data() {
            return {
                nombre: '',
                descripcion: '',
                arrayRespuesta: []
            }
        },
        methods: {
            enviar() {
                //console.log('se apreto enviar');
                let me = this;

                axios.post('/enviar', {
                    'titulo': me.nombre,
                    'descripcion': me.descripcion
                }).then(function (response) {
                    me.arrayRespuesta = response.data.respuesta;
                    console.log('se enviaron datos');
                }).catch(function (error) {
                    console.log(error);
                });
            }

        }
    }
</script>
