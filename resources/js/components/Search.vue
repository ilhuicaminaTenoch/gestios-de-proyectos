<template>
    <div>
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Buscador de personal</h3>
            </div>
            <div class="box-body">
                <input class="form-control input-lg" type="text" placeholder="Codigo" @keyup.enter="searchPerson(name)"
                       v-model="name">
            </div>
            <!-- /.box-body -->
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title" v-for="person in persons" :key="persons.id_contratista"
                        v-text="person.nombre"></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" v-if="persons.length">
                    <div class="alert alert-dismissible"
                         v-for="(key,index) in Object.keys(messages)"
                         v-bind:class="messages[key]['activeClass']"
                    >
                            <button type="button" class="close" aria-hidden="true">×</button>
                            <h4><i class="icon fa" v-bind:class="messages[key]['iconClass']"></i> Alerta!</h4>
                            {{ messages[key]['message'] }}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registro de Entrada y Salida</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-block btn-success"  @click="register(id, 1)">Entrada</button>
                                        <button type="button" class="btn btn-block btn-danger"  @click="register(id, 2)">Salida</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <div class="card" v-if="entradaSalida !== 0">
                            <div class="callout callout-success">
                                <h4 v-if="resultado[0].resultado === 0">Debes registrar antes la salida</h4>
                                <h4 v-else-if="resultado[0].resultado === 1">Se registro la entrada correctamente</h4>
                                <h4 v-else-if="resultado[0].resultado === 2">Se registro la salida correctamente</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal" @click="cleanAll()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
        props:['type'],
        data() {
            return {
                id: 0,
                name: '',
                fecha: '',
                persons: [],
                messages: [],
                entradaSalida: 0,
                resultado:0,
                urlRegister: this.type
            }
        },
        methods: {
            searchPerson(name) {

                var url = '/gestion/searchPerson?name=' + name;
                axios.get(url).then(response => {
                    this.persons = response.data.persons;
                    this.messages = this.message(this.persons);
                });
            },
            message: function (persons) {
                moment.locale('es');
                var total = persons.length;
                let messageData = {};
                if (total >= 1) {
                    var alertMedicalExam;
                    var messageInduccion;
                    var alertInduccion;
                    var messageMedicalExam;
                    var alertMedicalExam;
                    var messageSua;
                    var alertSua;
                    var iconInduccion;
                    var iconMedicalExam;
                    var iconSua;
                    var messageSuspension;
                    var alertSuspension;
                    var iconSuspension;


                    let dateNow = moment(new Date());
                    let endMont = new moment().endOf("month");
                    let month = moment(new Date()).format('MM');
                    let monthBd = this.monthDataBase(month);
                    let oneYearInduccion = moment(persons[0]['induccion']);
                    let oneYearMedicalExam = moment(persons[0]['examen_medico']);

                    let diciembre = persons[0]['diciembre'];
                    let febrero = persons[0]['febrero'];
                    let abril = persons[0]['abril'];
                    let junio = persons[0]['junio'];
                    let agosto = persons[0]['agosto'];
                    let octubre = persons[0]['octubre'];


                    if (dateNow.diff(oneYearInduccion, 'years', true) > 1) {
                        messageInduccion = 'Curso de inducción no está vigente';
                        alertInduccion = 'alert-danger';
                        iconInduccion = 'fa-ban';
                    } else {
                        messageInduccion = 'Curso de induccion vigente';
                        alertInduccion = 'alert-success';
                        iconInduccion = 'fa-check';
                    }

                    if (dateNow.diff(oneYearMedicalExam, 'years', true) > 1) {
                        messageMedicalExam = 'Examen médico ya no esta vigente';
                        alertMedicalExam = 'alert-danger';
                        iconMedicalExam = 'fa-ban';
                    } else {
                        messageMedicalExam = 'Examen médico vigente';
                        alertMedicalExam = 'alert-success';
                        iconMedicalExam = 'fa-check';
                    }



                    if (persons[0].hasOwnProperty(monthBd)) { // valida que el mes este en la BD ( diciembre, febrero, abril, junio, agosto, octubre )
                        const monthYesBD = this.monthYesDataBase(month);


                        switch (monthYesBD) {
                            case 'diciembre':
                                if (diciembre == 1) {
                                    messageSua = 'SUA al corriente';
                                    alertSua = 'alert-success';
                                    iconSua = 'fa-check';
                                } else {
                                    messageSua = 'No has entregado el SUA correspondiente';
                                    alertSua = 'alert-danger';
                                    iconSua = 'fa-ban';
                                }
                                break;
                            case 'febrero':
                                if (febrero == 1) {
                                    messageSua = 'SUA al corriente';
                                    alertSua = 'alert-success';
                                    iconSua = 'fa-check';
                                } else {
                                    messageSua = 'No has entregado el SUA correspondiente';
                                    alertSua = 'alert-danger';
                                    iconSua = 'fa-ban';
                                }
                                break;
                            case 'abril':
                                if (abril == 1) {
                                    messageSua = 'SUA al corriente';
                                    alertSua = 'alert-success';
                                    iconSua = 'fa-check';
                                } else {
                                    messageSua = 'No has entregado el SUA correspondiente';
                                    alertSua = 'alert-danger';
                                    iconSua = 'fa-ban';
                                }
                                break;
                            case 'junio':
                                if (junio == 1) {
                                    messageSua = 'SUA al corriente';
                                    alertSua = 'alert-success';
                                    iconSua = 'fa-check';
                                } else {
                                    messageSua = 'No has entregado el SUA correspondiente';
                                    alertSua = 'alert-danger';
                                    iconSua = 'fa-ban';
                                }
                                break;
                            case 'agosto':
                                if (agosto == 1) {
                                    messageSua = 'SUA al corriente';
                                    alertSua = 'alert-success';
                                    iconSua = 'fa-check';
                                } else {
                                    messageSua = 'No has entregado el SUA correspondiente';
                                    alertSua = 'alert-danger';
                                    iconSua = 'fa-ban';
                                }
                                break;
                            case 'octubre':
                                if (octubre == 1) {
                                    messageSua = 'SUA al corriente';
                                    alertSua = 'alert-success';
                                    iconSua = 'fa-check';
                                } else {
                                    messageSua = 'No has entregado el SUA correspondiente';
                                    alertSua = 'alert-danger';
                                    iconSua = 'fa-ban';
                                }
                                break;


                        }


                    } else { // meses faltantes (enero, marzo, mayo, julio, septiembre y noviembre)
                        const monthNoBD = this.monthNotDataBase(month);

                        if (persons[0][monthNoBD]) {
                            messageSua = 'SUA al corriente';
                            alertSua = 'alert-success';
                            iconSua = 'fa-check';
                        } else {
                            messageSua = 'No has entregado el SUA correspondiente';
                            alertSua = 'alert-danger';
                            iconSua = 'fa-ban';
                        }
                    }

                    //VALIDA SUSPENSION
                    const suspension = persons[0]['suspendido'];
                    const dateStart = moment(persons[0]['fechaISuspencion']).format("MMMM Do YYYY");
                    const dateEnd = moment(persons[0]['fechaFSuspencion']).format("MMMM Do YYYY");




                    if(suspension === 1){
                        const stringDateNow = moment(new Date()).format('YYYY-MM-DD');
                        const stringDateEnd = moment(persons[0]['fechaFSuspencion']).format("YYYY-MM-DD");
                        const stringDateInit = moment(persons[0]['fechaISuspencion']).format("YYYY-MM-DD");
                        dateNow = moment(stringDateNow);
                        const url = '/gestion/update-suspension?id_contratista=' + persons[0]['id_contratista'] + '&bandera=0' + '&controllerMethod=' + this.urlRegister;


                        if(dateNow.isBefore(stringDateInit)){ //dateNow < dateInit
                            //console.log('sin problemas');
                            axios.get(url).then(response => {
                                console.log('se hizo update');
                            });
                            messageSuspension = "Sin problemas";
                            alertSuspension = "alert-success";
                            iconSuspension = "fa-check";
                        }else if(dateNow.isAfter(stringDateEnd)){ //dateNow > dateEnd
                            axios.get(url).then(response => {
                                console.log('se hizo update');
                            });
                            messageSuspension = "Reactivado";
                            alertSuspension = "alert-success";
                            iconSuspension = "fa-check";
                        }else{
                           // console.log('contratista suspendido');
                            messageSuspension = "El contratista se encuentra suspendido. de "+ dateStart + " y "+ dateEnd;
                            alertSuspension = "alert-danger";
                            iconSuspension = "fa-ban";
                        }
                    }else {
                        messageSuspension = "Reactivado";
                        alertSuspension = "alert-success";
                        iconSuspension = "fa-check";
                    }

                    //insert
                    if (alertInduccion === 'alert-success' && alertMedicalExam === 'alert-success' && alertSua === 'alert-success' &&  alertSuspension === 'alert-success') {
                        this.fecha = moment().format("YYYY-MM-DD HH:mm:ss");
                        this.id = persons[0].id_contratista
                        this.name = '';
                        $('#modal-default').modal('show');
                    } else {
                        swal("Accesso Denegado!", "No cumple con los criterios de validación", "error");
                        this.name = '';
                    }

                    const messageData = {
                        induccion: {
                            message: messageInduccion,
                            activeClass: alertInduccion,
                            iconClass: iconInduccion
                        },
                        medicalExam: {
                            message: messageMedicalExam,
                            activeClass: alertMedicalExam,
                            iconClass: iconMedicalExam
                        },
                        sua: {
                            message: messageSua,
                            activeClass: alertSua,
                            iconClass: iconSua
                        },
                        suspension:{
                            message: messageSuspension,
                            activeClass: alertSuspension,
                            iconClass: iconSuspension
                        }
                    };
                    return messageData;
                }else{
                    swal("ERROR!", "El contratista se encuentra dado de baja", "error");
                }
            },
            monthDataBase(month) {
                let monthString = '';
                switch (month) {
                    case '01':
                        monthString = 'enero';
                        break;
                    case '02':
                        monthString = 'febrero';
                        break;
                    case '03':
                        monthString = 'marzo'
                        break;
                    case '04':
                        monthString = 'abril';
                        break;
                    case '05':
                        monthString = 'mayo';
                        break;
                    case '06':
                        monthString = 'junio';
                        break;
                    case '07':
                        monthString = 'julio';
                        break;
                    case '08':
                        monthString = 'agosto';
                        break;
                    case '09':
                        monthString = 'septiembre';
                        break;
                    case '10':
                        monthString = 'octubre';
                        break;
                    case '11':
                        monthString = 'noviembre';
                        break;
                    case '12':
                        monthString = 'diciembre';
                        break;
                }
                return monthString;
            },
            monthNotDataBase(month) {
                let monthString = '';
                if (month === '12' || month === '01') {
                    monthString = 'diciembre';
                } else if (month === '02' || month === '03') {
                    monthString = 'febrero';
                } else if (month === '04' || month === '05') {
                    monthString = 'abril';
                } else if (month === '06' || month === '07') {
                    monthString = 'junio';
                } else if (month === '08' || month === '09') {
                    monthString = 'agosto';
                } else if (month === '10' || month === '11') {
                    monthString = 'octubre';
                }
                return monthString;
            },
            monthYesDataBase(month) {
                let monthString = '';
                if (month === '01' || month === '02') {
                    monthString = 'diciembre';
                } else if (month === '03' || month === '04') {
                    monthString = 'febrero';
                } else if (month === '05' || month === '06') {
                    monthString = 'abril';
                } else if (month === '07' || month === '08') {
                    monthString = 'junio';
                } else if (month === '09' || month === '10') {
                    monthString = 'agosto';
                } else if (month === '11' || month === '12') {
                    monthString = 'octubre';
                }
                return monthString;
            },
            register(id_contratista, bandera) {
                //if (bandera !== 0) {
                    var url = '/gestion/register?id_contratista=' + id_contratista + '&bandera=' + bandera + '&controllerMethod=' + this.urlRegister;
                    let nombre = this.persons[0].nombre;
                    axios.get(url).then(response => {
                        this.resultado = response.data;
                        this.entradaSalida = 1;

                    });
                //}
            },
            cleanAll(){
                this.entradaSalida = 0;
                this.resultado = 0;
                this.persons = [];
                this.messages = [];
                this.fecha = '';
                this.name = '';
                this.id = '';
            },
            /*updateSuspencion(persons){
                if (persons[0]['suspendido']){
                    const stringDateNow = moment(new Date()).format('YYYY-MM-DD');
                    const stringDateEndSuspencion = moment(persons[0]['fechaFSuspencion']).format("YYYY-MM-DD");

                    const dateNow = moment(stringDateNow);
                    const dataEndSuspencion = moment(stringDateEndSuspencion);

                    console.log(dataEndSuspencion.diff(dateNow, 'days'));
                    if (dataEndSuspencion.diff(dateNow, 'days') === 0) {
                        console.log('entro');
                        var url = '/gestion/update-suspension?id_contratista=' + persons[0]['id_contratista'] + '&bandera=0' + '&controllerMethod=' + this.urlRegister;
                        axios.get(url).then(response => {
                            console.log(response);
                        });
                    }

                }
            }*/
        }
    }
</script>

