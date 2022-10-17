import api from '../request/apiAbsent.js';

export default (function () {
  // init scope
  let body = context.body;
  let app = context.app;

  // component
  // let modalAdd = app.find('#modal-add');
  let tgl2 = app.find('#tgl2');
  let tglMasuk = app.find('#tglMasuk');

  // event
  //   btnAnswer.on('click', actionClickBtnAnswer);

  // delegation event
  body.on('dp.change', '#tgl1', changeDate);
  body.on('dp.change', '#tgl2', changeDate);

  // delegation event

  // data
  let data = {
    days: ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'],
  };

  function init() {
    tglMasuk.datetimepicker({
      useCurrent: false,
      locale: 'id',
      format: 'DD-MM-YYYY',
    });
  }

  // start function action
  function changeDate(e) {
    let valTgl2 = tgl2.find('input').val();
    let arrDate = valTgl2.split('-');
    let dateTgl2 = new Date(arrDate.reverse().toString());
    let dateNext = new Date();
    if (data.days[dateTgl2.getDay()] == 'jumat') {
      dateNext.setDate(dateTgl2.getDate() + 3);
    } else if (data.days[dateTgl2.getDay()] == 'sabtu') {
      dateNext.setDate(dateTgl2.getDate() + 2);
    } else {
      dateNext.setDate(dateTgl2.getDate() + 1);
    }
    console.log(dateNext);
    tglMasuk.data('DateTimePicker').date(dateNext);
  }
  // end function action

  return {
    init,
  };
})();
