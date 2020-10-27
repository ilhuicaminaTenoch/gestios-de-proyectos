<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Consulta Contratistas</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Compañia</label>
                            <select v-model="comboCompanias" class="form-control">
                                <option value="0" selected>Selecciona un opcion</option>
                                <option value="00" selected>Todas</option>
                                <option v-for="compania in companias" v-bind:value="compania.id_compania" :key="compania.id_compania">
                                    {{ compania.compania }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipos">Tipo</label>
                            <select v-model="comboTipos" class="form-control">
                                <option value="0" selected>Selecciona un opcion</option>
                                <option value="1">Tipo 1</option>
                                <option value="2">Tipo 2</option>
                                <option value="3">Ambos</option>
                            </select>
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
                                    1,
                                    fechaInicio,
                                    fechaTermino,
                                    comboCompanias,
                                    comboTipos
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
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Contratistas encontrado</h3>
                    <div class="box-tools">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li v-if="pagination.current_page > 1">
                                <a href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,fechaInicio, fechaTermino, comboCompanias, comboTipos)">«</a>
                            </li>
                            <li v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a href="#" @click.prevent="cambiarPagina(page, fechaInicio, fechaTermino, comboCompanias,comboTipos)" v-text="page"></a>
                            </li>
                            <li v-if="pagination.current_page < pagination.last_page">
                                <a href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, fechaInicio, fechaTermino, comboCompanias,comboTipos)">»</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Compañia</th>
                                <th>Tipo</th>
                                <th>Contratista</th>
                                <th>Fecha inicio</th>
                                <th>Fecha termino</th>
                            </tr>
                            <tr v-for="contratista in contratistas" :key="contratista.ID">
                                <td v-text="contratista.compania"></td>
                                <td v-text="contratista.Tipo"></td>
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
                        >Exportar Excel</a
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
            companias: [],
            comboCompanias: 0,
            comboTipos: 0,
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
        cambiarPagina(page, fechaInicio, fechaTermino, compania, tipo){
            let me = this;
            me.pagination.current_page = page;
            me.consultaHorarios(page,fechaInicio, fechaTermino, compania, tipo);
        },
        checkForm() {
            this.errorForm = 0;
            this.errors = [];
            if (this.comboCompanias === 0) this.errors.push("La compañia es obligatorio.");
            if (this.comboTipos === 0) this.errors.push("El tipo es obligatorio.");
            if(!this.fechaInicio) this.errors.push('La fecha inicial no pude estar vacia.');
            if(!this.fechaTermino) this.errors.push('La fecha final no puede estar vacia');

            if (this.errors.length) this.errorForm = 1;

            return this.errorForm;
        },
        consultaHorarios(page, fechaInicio, fechaTermino, compania, tipo) {
            if (this.checkForm()) {
                return;
            }
            const url = "/Codigos/verifica-horarios?fechaInicio=" +fechaInicio +"&fechaTermino=" +fechaTermino +"&compania=" +compania+"&tipo="+tipo+"&page="+page;

            axios.get(url).then(response => {
                this.contratistas = response.data.results;
                this.pagination = response.data.pagination;
                this.nuevaUrl = "/Codigos/generate-pdf?data="+Buffer.from('fechaInicio=' +fechaInicio +'&fechaTermino='+fechaTermino +"&compania=" +compania+"&tipo="+tipo).toString('base64');
                if(this.contratistas.length > 0) this.activeClass = '';
            });
        },
        obtieneCompanias(){
            const url ="/Codigos/obtiene-companias";
            axios.get(url).then(response => {
                this.companias = response.data.empresas;
            });
        }
    },
    mounted() {
        this.obtieneCompanias();
    }
};
</script>
