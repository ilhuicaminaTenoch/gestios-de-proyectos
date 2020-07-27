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
                            <label for="mes">Mes</label>
                            <select class="form-control" v-model="mes">
                                <option value="0">Selecioner mes</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button
                            type="button"
                            class="btn btn-primary"
                            v-on:click="
                                consultaExamenInduccion(
                                    mes,
                                    1
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
                    <div class="box-tools">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li v-if="pagination.current_page > 1">
                                <a href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, mes)">«</a>
                            </li>
                            <li v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a href="#" @click.prevent="cambiarPagina(page, mes)" v-text="page"></a>
                            </li>
                            <li v-if="pagination.current_page < pagination.last_page">
                                <a href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, mes)">»</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nombre</th>
                                <th>Induccion</th>
                                <th>Examen Medico</th>
                            </tr>
                            <tr v-for="contratista in contratistas" :key="contratista.id_contratista">
                                <td v-text="contratista.Contratistas"></td>
                                <td v-text="contratista.induccion"></td>
                                <td v-text="contratista.examen_medico"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a 
                        class="btn btn-app btn-primary"
                        v-bind:class="[activeClass]"
                        v-bind:href="nuevaUrl"
                        role="button"
                        aria-disabled="true"
                    >
                        <i class="fa fa-file-pdf-o"></i> PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                mes: '0',
                activeClass: 'disabled',
                nuevaUrl: '',
                contratistas: [],
                errorForm: 0,
                errors: [],
                pagination :{
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0
                },
                offset : 10,
                buscar:'',
            }
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
            cambiarPagina(page, mes){
                let me = this;
                me.pagination.current_page = page;
                me.consultaExamenInduccion(mes, page);
            },
            checkForm() {
                this.errorForm = 0;
                this.errors = [];
                if (this.mes == '0') this.errors.push("El mes es obligatorio.");
                if (this.errors.length) this.errorForm = 1;

                return this.errorForm;
            },
            consultaExamenInduccion(mes, page) {
                if (this.checkForm()) {
                    return;
                }
                const url = "/Codigos/reporte-medico-e-induccion?mes=" + mes+'&page=' + page;
                axios.get(url).then(response => {
                    this.contratistas = response.data.results;
                    this.pagination = response.data.pagination;
                    this.nuevaUrl = "/Codigos/reporte-pdf-medico-induccion?data="+Buffer.from('mes='+mes).toString('base64'); 
                    if(this.contratistas.length > 0) this.activeClass = '';
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>