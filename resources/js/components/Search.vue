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
                persons: [],
                messages: [],
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
                let month = moment(new Date()).format('MM');
                let monthBd = this.monthDataBase(month);
                let oneYearInduccion = moment(persons[0]['induccion']).add(1, 'year');
                let oneYearMedicalExam = moment(persons[0]['examen_medico']).add(1, 'year');

                if (dateNow.diff(oneYearInduccion) > 0) {
                    messageInduccion = 'Curso de induccion vijente';
                    alertInduccion = 'alert-success';
                    iconInduccion = 'fa-check';
                } else {
                    messageInduccion = 'Curso de inducción no está vigente';
                    alertInduccion = 'alert-danger';
                    iconInduccion = 'fa-ban';
                }

                if (dateNow.diff(oneYearMedicalExam) > 0) {
                    messageMedicalExam = 'Examen médico vigente';
                    alertMedicalExam = 'alert-success';
                    iconMedicalExam = 'fa-check';
                } else {
                    messageMedicalExam = 'Examen médico ya no esta vigente';
                    alertMedicalExam = 'alert-danger';
                    iconMedicalExam = 'fa-ban';
                }
                if (persons[0][monthBd]) {
                    messageSua = 'SUA al corriente';
                    alertSua = 'alert-success';
                    iconSua = 'fa-check';
                } else {
                    messageSua = 'No has entregado el SUA correspondiente';
                    alertSua = 'alert-danger';
                    iconSua = 'fa-ban';

                }

                const messageData = {
                    induccion : {
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
            monthDataBase(month){
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
            }

        }
    }
</script>
