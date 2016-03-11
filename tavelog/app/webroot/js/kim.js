jQuery(function($) {
  $('#convert-submit').submit(function(event) {
    // HTMLでの送信をキャンセル
    event.preventDefault();

    // 操作対象のフォーム要素を取得
    var $form = $(this);

    // 送信ボタンを取得
    // （後で使う: 二重送信を防止する。）
    var $button = $form.find('button');

    // 送信
    $.ajax({
      url: $form.attr('action'),
      type: $form.attr('method'),
      data: $form.serialize()
      + '&delay=1',  // （デモ用に入力値をちょいと操作します）
      timeout: 10000,  // 単位はミリ秒

      // 送信前
      beforeSend: function(xhr, settings) {
        // ボタンを無効化し、二重送信を防止
        $button.attr('disabled', true);
      },
      // 応答後
      complete: function(xhr, textStatus) {
        // ボタンを有効化し、再送信を許可
        $button.attr('disabled', false);
      },

      // 通信成功時の処理
      success: function(result, textStatus, xhr) {
        // 入力値を初期化
        $form[0].reset();

        var div = $('<tr><td>'+result.word+'</td>'+'<td>'+result.result+'</td></tr>');
        $(".result").prepend(div);
      },

      // 通信失敗時の処理
      error: function(xhr, textStatus, error) {}
    });
  });
});