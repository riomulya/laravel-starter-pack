{{-- @extend('layout.head'); --}}

<div id="toast" class="toast toast-top toast-end z-50">
    <div role="alert" class="alert alert-{{ $type }}">
        @if ($type == 'success')
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        @elseif ($type == 'error')
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        @endif
        <span>{{ $message }}</span>
    </div>

</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var toast = document.getElementById('toast');
            if (toast) {
                toast.style.display = 'none';
            }
        }, 5000); // 5000 milidetik = 5 detik
    });
</script>
