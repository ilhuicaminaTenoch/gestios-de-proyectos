<template>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Buscador de personal</h3>
        </div>
        <div class="box-body">
            <input class="form-control input-lg" type="text" placeholder="Codigo" @keyup.enter="searchPerson(id)"
                   v-model="id">
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

</template>

<script>
    import moment from "moment";

    export default {
        data() {
            return {
                id: 0,
                fecha: '',
                persons: [],
                messages: [],
                messageRegister: '',
            }
        },
        methods: {
            searchPerson(id) {
                var url = '/gestion/searchPerson?id=' + id;
                axios.get(url).then(response => {
                    this.persons = response.data.persons;
                    this.messages = this.message(this.persons);
                });
            },
            message: function (persons) {
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


                let dateNow = moment(new Date());
                let endMont = new moment().endOf("month");
                let month = moment(new Date()).format('MM');
                let monthBd = this.monthDataBase(month);
                let oneYearInduccion = moment(persons[0]['induccion'])
                let oneYearMedicalExam = moment(persons[0]['examen_medico']);

                if (dateNow.diff(oneYearInduccion,'years', true) > 1) {
                    messageInduccion = 'Curso de inducción no está vigente';
                    alertInduccion = 'alert-danger';
                    iconInduccion = 'fa-ban';
                } else {
                    messageInduccion = 'Curso de induccion vijente';
                    alertInduccion = 'alert-success';
                    iconInduccion = 'fa-check';
                }

                if (dateNow.diff(oneYearMedicalExam,'years', true) > 1) {
                    messageMedicalExam = 'Examen médico ya no esta vigente';
                    alertMedicalExam = 'alert-danger';
                    iconMedicalExam = 'fa-ban';
                } else {
                    messageMedicalExam = 'Examen médico vigente';
                    alertMedicalExam = 'alert-success';
                    iconMedicalExam = 'fa-check';
                }



                if (persons[0].hasOwnProperty(monthBd)){ // valida que el mes este en la BD ( diciembre, febrero, abril, junio, agosto, octubre )
                    if (dateNow > endMont) {
                        messageSua = 'No has entregado el SUA correspondiente';
                        alertSua = 'alert-danger';
                        iconSua = 'fa-ban';
                    } else {
                        messageSua = 'SUA al corriente';
                        alertSua = 'alert-success';
                        iconSua = 'fa-check';
                    }
                }else{ // meses faltantes (enero, marzo, mayo, julio, septiembre y noviembre)
                    const monthNoBD = this.monthNotDataBase(month);
                    if (persons[0][monthNoBD]){
                        messageSua = 'SUA al corriente';
                        alertSua = 'alert-success';
                        iconSua = 'fa-check';
                    }else{
                        messageSua = 'No has entregado el SUA correspondiente';
                        alertSua = 'alert-danger';
                        iconSua = 'fa-ban';
                    }
                }

                //insert
                if (alertInduccion == 'alert-success' && alertMedicalExam == 'alert-success' && alertSua == 'alert-success'){
                    this.fecha = moment().format("YYYY-MM-DD HH:mm:ss");
                    this.register(this.id, this.fecha)
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
                    }
                };

                return messageData;


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
            monthNotDataBase(month){
                let monthString = '';
                if (month == '12' || month == '01'){
                    monthString = 'diciembre';
                }else if(month == '02' || month == '03'){
                    monthString = 'febrero';
                }else if(month == '04' || month == '05'){
                    monthString = 'abril';
                }else if(month == '06' || month == '07'){
                    monthString = 'junio';
                }else if(month == '08' || month == '09'){
                    monthString = 'agosto';
                }
                return monthString;
            },
            register(id_contratista, fecha){
                var url = '/gestion/register?id_contratista=' + id_contratista + '&fecha=' + fecha;
                axios.get(url).then(response => {
                    console.log('se inserto');
                    swal("Registro Guardado!", "Se ha registrado un contratista", "success");

                });
            }
        }
    }
</script>
