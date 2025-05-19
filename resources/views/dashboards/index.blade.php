<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite('resources/css/app.css')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
</head>

<body>
    <nav class="mb-8 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl sm:px-0">
            <div class="flex items-center justify-between py-4">
                <a href="{{ route('dashboard.index') }}" class="text-xl font-bold">Dashboard <span
                        class="transition duration-300 hover:text-gray-500">JPRD</span></a>
                <div class="md:hidden">
                    <button type="button"
                        class="text-gray-900 transition-transform duration-300 hover:text-black focus:outline-none active:scale-95"
                        id="mobile-menu-button">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="menu-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div x-data="{ showAlert: true }" x-show="showAlert" x-init="setTimeout(() => showAlert = false, 5000)"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="p-4 mx-auto mb-4 text-green-700 bg-green-100 rounded-lg max-w-7xl">
                {{ session('success') }}
                <button onclick="this.parentElement.remove()" class="absolute top-2 right-2">×</button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div x-data="{ showAlert: true }" x-show="showAlert" x-init="setTimeout(() => showAlert = false, 5000)"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="px-4 py-3 mx-auto mb-4 text-red-700 bg-red-100 border border-red-400 rounded max-w-7xl">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div>

    @endif


    <div
        class="flex items-center justify-between px-4 py-3 mx-auto mb-8 rounded-lg shadow-md sm:px-6 lg:px-8 bg-gray-50 max-w-7xl">
        <h1 class="text-lg font-bold text-gray-800 sm:text-xl">Semua Gambar</h1>
        <button type="button" id="add-photo"
            class="p-2 text-white transition-colors bg-blue-600 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                <path
                    d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z" />
                <path
                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0" />
            </svg>
            <span class="sr-only">Tambah Gambar</span>
        </button>
    </div>

    {{-- Modal --}}
    <div class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50" id="modal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="w-11/12 p-6 bg-white rounded-lg shadow-lg md:w-1/2 lg:w-1/3">
                <h2 class="mb-4 text-xl font-bold">Tambah Gambar</h2>

                <!-- Tampilkan error validasi global -->
                @if ($errors->any())
                    <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-300 rounded-lg">
                        <ul class="pl-5 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 text-gray-500">
                        <label for="title" class="block mb-1 text-sm font-medium">Title</label>
                        <input type="text" name="title" id="title"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('title') border-red-500 @enderror"
                            placeholder="Masukkan judul gambar" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4 text-gray-500">
                        <label for="description" class="block mb-1 text-sm font-medium">Deskripsi</label>
                        <textarea name="description" id="description"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('description') border-red-500 @enderror"
                            rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4 text-gray-500">
                        <label for="image" class="block mb-1 text-sm font-medium">Gambar (Maks. 5MB)</label>
                        <input type="file" name="image" id="image"
                            class="w-full file:font-medium file:bg-sky-100 file:text-sky-500 hover:cursor-pointer file:border-0 file:rounded-full file:py-2 file:px-4 file:mr-2 file:text-sm @error('image') border-red-500 @enderror"
                            required>
                        @error('image')
                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                        <p class="mt-1 text-xs text-gray-400">Format: JPEG, PNG, JPG | Maksimal 5MB</p>
                    </div>

                    <div class="flex justify-end gap-2 text-sm">
                        <button type="button" id="close-modal" class="px-4 py-2 mt-4 text-rose-500">Batalkan</button>
                        <button type="submit"
                            class="px-4 py-2 mt-4 rounded-full bg-sky-100 text-sky-500">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Daftar Gambar --}}
    <div class="grid items-center grid-cols-6 gap-1 mx-auto max-w-7xl">
        @if ($photos->isEmpty())
            <div class="col-span-6 text-center">
                <h1 class="text-2xl">Belum ada gambar ditambahkan</h1>
            </div>
        @else
            @foreach ($photos as $photo)
                <div class="relative col-span-1 group">
                    <img src="{{ asset('storage/app/public/' . $photo->image) }}" alt="{{ $photo->title }}"
                        class="object-contain w-full transition duration-300 group-hover:opacity-75">

                    <!-- Overlay dengan tombol -->
                    <div
                        class="absolute inset-0 flex items-center justify-center gap-4 transition-opacity duration-300 bg-black opacity-0 group-hover:opacity-100 bg-opacity-40">
                        <!-- Edit Button -->
                        <button type="button" id="editButton-{{ $photo->id }}"
                            onclick="openEditModal('{{ $photo->id }}')"
                            class="p-3 text-white transition-transform duration-300 transform scale-90 bg-blue-500 rounded-full group-hover:scale-100 hover:bg-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('dashboard.destroy', $photo->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="p-3 text-white transition-transform duration-300 transform scale-90 bg-red-500 rounded-full group-hover:scale-100 hover:bg-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div id="editModal-{{ $photo->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                    <div
                        class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        <!-- Background overlay -->
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <!-- Modal content -->
                        <div
                            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                                <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900">Edit Photo</h3>
                                <form id="editForm-{{ $photo->id }}"
                                    action="{{ route('dashboard.update', $photo->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="title-{{ $photo->id }}"
                                            class="block mb-1 text-sm font-medium text-gray-500">Title</label>
                                        <input type="text" name="title" id="title-{{ $photo->id }}"
                                            value="{{ $photo->title }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                    </div>
                                    <div class="mb-4">
                                        <label for="description-{{ $photo->id }}"
                                            class="block mb-1 text-sm font-medium text-gray-500">Description</label>
                                        <textarea type="text" name="title" id="title-{{ $photo->id }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg" rows="3">{{ old('description', $photo->description) }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="image-{{ $photo->id }}"
                                            class="block mb-2 text-sm font-medium text-gray-500">Image</label>
                                        <input type="file" name="image" id="image-{{ $photo->id }}"
                                            class="w-full file:font-medium file:bg-sky-100 file:text-sky-500 hover:cursor-pointer file:border-0 file:rounded-full file:py-2 file:px-4 file:mr-2 file:text-sm">
                                    </div>
                                </form>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" onclick="submitEditForm('{{ $photo->id }}')"
                                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Save Changes
                                </button>
                                <button type="button" onclick="closeEditModal('{{ $photo->id }}')"
                                    class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addPhotoButton = document.getElementById('add-photo');
            const modal = document.getElementById('modal');
            const closeModalButton = document.getElementById('close-modal');

            addPhotoButton.addEventListener('click', function() {
                modal.classList.remove('hidden');
            });

            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Close modal when clicking outside of it
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });

        function openEditModal(photoId) {
            document.getElementById(`editModal-${photoId}`).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        // Fungsi untuk menutup modal
        function closeEditModal(photoId) {
            document.getElementById(`editModal-${photoId}`).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Fungsi untuk submit form
        function submitEditForm(photoId) {
            document.getElementById(`editForm-${photoId}`).submit();
        }

        // Tutup modal ketika klik di luar area modal
        window.onclick = function(event) {
            const modals = document.querySelectorAll('[id^="editModal-"]');
            modals.forEach(modal => {
                if (event.target === modal) {
                    const photoId = modal.id.split('-')[1];
                    closeEditModal(photoId);
                }
            });
        }

        // Auto-show modal jika ada error
        @if ($errors->any())
            document.getElementById('modal').classList.remove('hidden');
        @endif

        // Close modal handler
        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });
    </script>
</body>

</html>
