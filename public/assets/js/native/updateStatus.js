$.fn.editable.defaults.mode = "inline";
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": "{{csrf_token()}}",
    },
});

$(".update").editable({
    url: "{{ route('update-status') }}",
    type: "text",
});
