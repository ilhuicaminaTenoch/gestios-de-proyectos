<template>
    <div class="row">
        <div class="col-md-6">
          <!-- general form elements -->
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
                  <input type="text" v-model="nombre" class="form-control" id="exampleInputEmail1" placeholder="Contratista">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Fecha inicial</label>
                  <input type="date" v-model="fechaInicio" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Fecha final</label>
                  <input type="date" v-model="fechaTermino" id="exampleInputFile" class="form-control">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-primary" v-on:click="consultaHorarios(fechaInicio, fechaTermino, nombre)">Consultar</button>
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
                            <tr v-for="contratista in contratistas" :key="contratista.id_contratista">
                                <td v-text="contratista.contratista"></td>
                                <td v-text="contratista.fecha_inicial"></td>
                                <td v-text="contratista.fecha_final"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-danger" v-bind:href="nuevaUrl" role="button">Exportar a PDF</a>
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
            pagination :{
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0
            },
            offset : 3,
            nuevaUrl: '',
        };
    },
     computed:{
        isActived: function () {
            return this.pagination.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumber: function() {
            if(!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if(from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while(from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },

    methods: {
        consultaHorarios(fechaInicio, fechaTermino, nombre) {
            const url =
                "/Codigos/verifica-horarios?fechaInicio=" +
                fechaInicio +
                "&fechaTermino=" +
                fechaTermino +
                "&nombre=" +
                nombre;
                this.nuevaUrl = '';
            axios.get(url).then(response => {
                this.contratistas = response.data;
                this.nuevaUrl = "/Codigos/generate-pdf?fechaInicio=" +fechaInicio +"&fechaTermino=" +fechaTermino +"&nombre=" +nombre;
            });
        },
    },
    mounted() {
        this.contratistas('2020-07-01', '2020-07-02','');
    }
};
</script>
