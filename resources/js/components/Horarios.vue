<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Horarios</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nombre" class="col-sm-2 control-label"
                                >Contratista</label
                            >

                            <div class="col-sm-10">
                                <input
                                    type="email"
                                    class="form-control"
                                    id="nombre"
                                    v-model="nombre"
                                    placeholder="Nombre"
                                />
                            </div>
                        </div>
                        <div class="form-group">
                            <label
                                for="fechaInicio"
                                class="col-sm-2 control-label"
                                >Fecha de inicio</label
                            >

                            <div class="col-sm-10">
                                <input
                                    type="date"
                                    class="form-control"
                                    id="fechaInicio"
                                    v-model="fechaInicio"
                                />
                            </div>
                        </div>
                        <div class="form-group">
                            <label
                                for="fechaTermino"
                                class="col-sm-2 control-label"
                                >Fecha de termino</label
                            >

                            <div class="col-sm-10">
                                <input
                                    type="date"
                                    class="form-control"
                                    id="fechaTermino"
                                    v-model="fechaTermino"
                                />
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">
                            Consultar
                        </button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: 0,
            nombre: "",
            fechaInicio: "",
            fechaTermino: ""
        };
    },
    methods: {
        consultaHorarios(nombre, fechaInicio, fechaTermino){
            const url = '/Codigos/verifica-horarios?nombre=' + name + '&fechaInicio=' + fechaInicio + '&fechaTermino=' + fechaTermino;
            axios.get(url).then(response => {
                this.persons = response.data.persons;
                this.messages = this.message(this.persons);
            });

        }
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
