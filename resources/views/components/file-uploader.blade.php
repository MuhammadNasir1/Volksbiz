<div class="relative flex items-center justify-center w-full h-full" id="{{$id}}">
    <label
        class="file-upload-label flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-md cursor-pointer bg-gray-50">
        <div class="file-upload-content flex flex-col items-center justify-center pt-5 pb-6">
            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                    class="font-semibold">{{ $title }}</span>
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $requirements }}</p>
        </div>
        <input type="file" class="file-input hidden" name="{{ $name }}" accept="image/*"
            onchange="previewFile(event)" />
        <img class="file-preview absolute top-0 left-0 w-full h-full object-contain hidden bg-black rounded-lg" />
    </label>
</div>

<script>
    function previewFile(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = event.target.closest('.file-upload-label').querySelector('.file-preview');
                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>
