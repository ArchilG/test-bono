$(function () {
    $('input[name="fields[]"]').on('change', function () {
        let fields = [];
        let baseUrl = $(this).data('url')
        $('input[name="fields[]"]:checked').each(function () {
            fields.push($(this).val())
        })
        document.location.href = baseUrl + ( baseUrl.indexOf('?') >= 0 ? '&' : '?' ) + $.param( {'fields': fields} )
    })

    $('.ajax-form').on('submit', function (e) {
        e.preventDefault()
        let _this = $(this)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: $(this).attr('action'),
            method: 'post',
            dataType: 'json',
            data: _this.serialize(),
            success: function(response){
                _this.trigger('reset')
                alert('Seccess id: ' + response.id)
            }
        });
    })
})
