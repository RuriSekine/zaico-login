$(document).ready(function() {
    
    // CSRFトークンをAjaxリクエストに自動的に含める
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#search-icon').click(function(event) {
        event.preventDefault();
        // フォームデータを個別に収集
        var keyword = $('input[name="keyword"]').val();
        var company_name = $('select[name="company_name"]').val();
        var price_min = $('input[name="price_min"]').val();
        var price_max = $('input[name="price_max"]').val();
        var stock_min = $('input[name="stock_min"]').val();
        var stock_max = $('input[name="stock_max"]').val();

        // フォームの data-search-list-url 属性から URL を取得
        var searchUrl = $('#search-form').data('search-list-url');

        // 非同期リクエストを送信
        $.ajax({
            url: searchUrl, 
            method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'), // CSRFトークンを含める
            keyword: keyword,
            company_name: company_name,
            price_min: price_min,
            price_max: price_max,
            stock_min: stock_min,
            stock_max: stock_max
            },
        
        success: function(response) {
              // 成功時に商品リストを更新
                $('#product-list').html(response);
              // tablesorterの再初期化
                $('#product-table').tablesorter({
                    sortList: [[0, 0]],
                    headers: {
                    1: { sorter: false }, // 商品画像カラムのソート無効化
                    2: { sorter: false }, // 商品名カラムのソート無効化
                    5: { sorter: false }, // メーカー名カラムのソート無効化
                    6: { sorter: false }, // 新規登録ボタンのカラムのソート無効化
                    }
                });
            },
            error: function(xhr) {
              // エラーハンドリング
            alert('検索に失敗しました');
            }
        });
    });

    function bindDeleteEvent() {

        $('.product-delete').off('click');

        $('.product-delete').on('click', function(event) {
            event.preventDefault(); 

            // フォームデータを収集
            var form = $(this);

            // 商品の行を非表示にする処理
            form.closest('tr').fadeOut('fast', function() {
            // 非表示になった後にアラートを表示
            alert('削除(非表示)にしました');
            });
        });
    }
    
    // 初期の削除イベントバインド
    bindDeleteEvent();
});