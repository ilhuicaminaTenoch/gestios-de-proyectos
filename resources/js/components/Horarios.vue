<template>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Consulta Contratistas</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input
                                type="text"
                                v-model="nombre"
                                class="form-control"
                                id="exampleInputEmail1"
                                placeholder="Contratista"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"
                                >Fecha inicial</label
                            >
                            <input
                                type="date"
                                v-model="fechaInicio"
                                class="form-control"
                                id="exampleInputPassword1"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Fecha final</label>
                            <input
                                type="date"
                                v-model="fechaTermino"
                                id="exampleInputFile"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button
                            type="button"
                            class="btn btn-primary"
                            v-on:click="
                                consultaHorarios(
                                    fechaInicio,
                                    fechaTermino,
                                    nombre
                                )
                            "
                        >
                            Consultar
                        </button>
                    </div>

                    <div v-show="errorForm" class="alert alert-danger alert-dismissible">
                        <button
                            type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-hidden="true"
                        >
                            ×
                        </button>
                        <h4><i class="icon fa fa-ban"></i>Por favor, corrija el(los) siguiente(s) error(es):</h4>
                        <p
                            v-for="error in errors"
                            :key="error"
                            v-text="error"
                        >
                        </p>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Contratistas encontrados</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Contratista</th>
                                <th>Fecha inicio</th>
                                <th>Fecha termino</th>
                            </tr>
                            <tr v-for="contratista in contratistas" :key="contratista.dia">
                                <td v-text="contratista.contratista"></td>
                                <td v-text="contratista.fecha_inicial"></td>
                                <td v-text="contratista.fecha_final"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a
                        class="btn btn-danger"
                        v-bind:class="[activeClass]"
                        v-bind:href="nuevaUrl"
                        role="button"
                        aria-disabled="true"
                        >Exportar a PDF</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            nombre: "",
            fechaInicio: "",
            fechaTermino: "",
            contratistas: [],
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3,
            nuevaUrl: "",
            errors: [],
            errorForm: 0,
            activeClass: 'disabled',
        };
    },

    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },

    methods: {
        checkForm() {
            this.errorForm = 0;
            this.errors = [];
            if (!this.nombre) this.errors.push("El nombre es obligatorio.");
            if(!this.fechaInicio) this.errors.push('La fecha inicial no pudde estar vacia.');
            if(!this.fechaTermino) this.errors.push('La fecha fianl no puede estar vacia');

            if (this.errors.length) this.errorForm = 1;

            return this.errorForm;
        },
        consultaHorarios(fechaInicio, fechaTermino, nombre) {
            if (this.checkForm()) {
                return;
            }
            const url = "/Codigos/verifica-horarios?fechaInicio=" +fechaInicio +"&fechaTermino=" +fechaTermino +"&nombre=" +nombre;
            axios.get(url).then(response => {
                this.contratistas = response.data;
                this.nuevaUrl = "/Codigos/generate-pdf?data="+Buffer.from('fechaInicio=' +fechaInicio +'&fechaTermino='+fechaTermino +"&nombre=" +nombre).toString('base64'); 
                if(this.contratistas.length > 0) this.activeClass = '';
            });
        }
    },
    mounted() {
        //this.consultaHorarios("2020-07-01", "2020-07-02", "");
    }
};
</script>
