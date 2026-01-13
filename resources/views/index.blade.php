<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <title>SMTP Test</title>
</head>
<body class="bg-gray-800 p-6">
    <h1 class="text-white text-7xl text-center font-extrabold pb-10">SMTP Test</h1>

    <div class="flex flex-col gap-4 justify-center items-center">
    <button type="button" class="bg-blue-600 p-4 text-2xl rounded-3xl text-white w-50" id="testBtn"> Test</button>
        <div class="flex bg-gray-700 w-[60vw] max-h-[40vh] mx-auto  rounded-2xl text-slate-100 p-3">
            <div class="flex-1">
                <p>MAIL_HOST: {{ env('MAIL_HOST') ?? 'N/A' }}</p>
                <p>MAIL_PORT: {{ env('MAIL_PORT') ?? 'N/A' }}</p>
                <p>MAIL_USERNAME: {{ env('MAIL_USERNAME') ?? 'N/A' }}</p>
            </div>
            <div class="flex-1">
                <p>MAIL_PASSWORD: {{ env('MAIL_PASSWORD') ?? 'N/A' }}</p>
                <p>MAIL_FROM_ADDRESS: {{ env('MAIL_FROM_ADDRESS') ?? 'N/A' }}</p>
                <p>MAIL_FROM_NAME: {{ env('MAIL_FROM_NAME') ?? 'N/A' }}</p>
            </div>
        </div>
        <hr class="w-[60vw]">
        <div class="bg-gray-950 w-[60vw] h-[40vh] mx-auto block rounded-2xl overflow-x-hidden overflow-y-scroll text-slate-100 p-3" id="output">
            <em class="text-gray-700">Output will be shown here</em>
        </div>
    </div>
    <script>
        $('#testBtn').on('click', function(e){
            $('#testBtn').html('Please Wait...');
            $(this).removeClass('bg-blue-600').addClass('bg-orange-600').prop('disabled', true);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'post',
                url: '/test-email',
                success: function(response){
                    $('#output').html(response).addClass('text-white').removeClass('text-red-500');
                    $('#testBtn').removeClass('bg-orange-600').addClass('bg-blue-600').prop('disabled', false).html('Test');
                },
                error: function(jqXHR, status, error){
                 console.log(jqXHR)
                    let html = "XHR: "+jqXHR.status+"<br>";
                        html += "Status: "+status+"<br>";
                        html += "Error: "+ error+"<br><br><br>";
                        html += jqXHR.responseText;
                    $('#output').html(html).removeClass('text-white').addClass('text-red-500');
                    $('#testBtn').html('Test');
                    $('#testBtn').removeClass('bg-orange-600').addClass('bg-blue-600').prop('disabled', false).html('Test');
                }
            })
        });
    </script>
</body>
</html>