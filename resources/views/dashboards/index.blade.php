<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite('resources/css/app.css')

</head>

<body>
    <nav class="bg-gray-50 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-0">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('dashboard.index') }}" class="font-bold text-xl">Dashboard <span
                        class="hover:text-gray-500 transition duration-300">Jester Production</span></a>
                <div class="md:hidden">
                    <button type="button"
                        class="text-gray-900 hover:text-black focus:outline-none transition-transform duration-300 active:scale-95"
                        id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="menu-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex justify-between items-center max-w-7xl mx-auto px-4 py-2 bg-gray-50 shadow mb-8">
        <h1 class="font-bold">Semua Gambar</h1>
        <button type="button" id="add-photo">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                <path
                    d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z" />
                <path
                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0" />
            </svg>
        </button>
    </div>

    {{-- Modal --}}
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden" id="modal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 md:w-1/2 lg:w-1/3">
                <h2 class="text-xl font-bold mb-4">Tambah Gambar</h2>
                <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="text-gray-500 mb-4">
                        <label for="title" class="block mb-1 text-sm font-medium">Title</label>
                        <input type="text" name="title" id="title"
                            class="w-full border border-gray-300 rounded-lg py-2 px-4 "
                            placeholder="Masukkan judul gambar" required>
                    </div>
                    <div class="text-gray-500 mb-4">
                        <label for="description" class="block mb-1 text-sm font-medium">Deskripsi</label>
                        <textarea type="text" name="description" id="description" class="w-full border border-gray-300 rounded-lg py-2 px-4"
                            rows="3"></textarea>
                    </div>
                    <div class="text-gray-500 mb-4">
                        <label for="image" class="block mb-1 text-sm font-medium">Gambar</label>
                        <input type="file" name="image" id="image"
                            class="w-full file:font-medium file:bg-sky-100 file:text-sky-500 hover:cursor-pointer file:border-0 file:rounded-full file:py-2 file:px-4 file:mr-2 file:text-sm"
                            required>
                    </div>
                    <div class="flex gap-2 justify-end text-sm">
                        <button id="close-modal" class="mt-4 text-rose-500 px-4 py-2">Batalkan</button>
                        <button id="close-modal"
                            class="mt-4 bg-sky-100 text-sky-500 px-4 py-2 rounded-full">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Daftar Gambar --}}
    <div class="grid grid-cols-6 max-w-7xl mx-auto items-center">
        @if ($photos->isEmpty())
            <div class="col-span-6 text-center">
                <h1 class="text-2xl">Belum ada gambar ditambahkan</h1>
            </div>
        @else
            @foreach ($photos as $photo)
                <div class="col-span-1 relative group">
                    <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}"
                        class="w-full object-contain transition duration-300 group-hover:opacity-75">

                    <!-- Overlay dengan tombol -->
                    <div
                        class="absolute inset-0 flex items-center justify-center gap-4 opacity-0
                group-hover:opacity-100 transition-opacity duration-300 bg-black bg-opacity-40">
                        <!-- Edit Button -->
                        <button type="button" id="editButton-{{ $photo->id }}"
                            onclick="openEditModal('{{ $photo->id }}')"
                            class="transform scale-90 group-hover:scale-100 transition-transform duration-300
                  bg-blue-500 hover:bg-blue-600 text-white p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
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
                                class="transform scale-90 group-hover:scale-100 transition-transform duration-300
                           bg-red-500 hover:bg-red-600 text-white p-3 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
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
                        class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <!-- Background overlay -->
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <!-- Modal content -->
                        <div
                            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2">Edit Photo</h3>
                                <form id="editForm-{{ $photo->id }}"
                                    action="{{ route('dashboard.update', $photo->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="title-{{ $photo->id }}"
                                            class="block text-gray-500 text-sm font-medium mb-1">Title</label>
                                        <input type="text" name="title" id="title-{{ $photo->id }}"
                                            value="{{ $photo->title }}"
                                            class="w-full border border-gray-300 rounded-lg py-2 px-4">
                                    </div>
                                    <div class="mb-4">
                                        <label for="description-{{ $photo->id }}"
                                            class="block text-gray-500 text-sm font-medium mb-1">Title</label>
                                        <textarea type="text" name="title" id="title-{{ $photo->id }}" value="{{ $photo->description }}"
                                            class="w-full border border-gray-300 rounded-lg py-2 px-4" rows="3"></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="image-{{ $photo->id }}"
                                            class="block text-gray-500 text-sm font-medium mb-2">Image</label>
                                        <input type="file" name="image" id="image-{{ $photo->id }}"
                                            class="w-full file:font-medium file:bg-sky-100 file:text-sky-500 hover:cursor-pointer file:border-0 file:rounded-full file:py-2 file:px-4 file:mr-2 file:text-sm">
                                    </div>
                                </form>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" onclick="submitEditForm('{{ $photo->id }}')"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Save Changes
                                </button>
                                <button type="button" onclick="closeEditModal('{{ $photo->id }}')"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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
    </script>
</body>

</html>
