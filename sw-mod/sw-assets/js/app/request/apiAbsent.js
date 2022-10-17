// API Request Ajax
export default {
  // ajax
  getExamQuestion: function (param, success, error) {
    $.ajax({
      type: 'GET',
      url: base_url + 'user/exam-accuracy/questions/' + param,
      dataType: 'JSON',
      success,
      error,
    });
  },
  postPresent: function (data, success, error) {
    $.ajax({
      type: 'POST',
      url: './sw-proses?action=absent-selfie',
      processData: false,
      contentType: false,
      data: data,
      success,
      error,
    });
  },
  postExamQuestion: function (data, success, error) {
    $.ajax({
      type: 'POST',
      url: base_url + 'user/exam/submit-exam',
      dataType: 'JSON',
      data: data,
      success,
      error,
    });
  },
};
