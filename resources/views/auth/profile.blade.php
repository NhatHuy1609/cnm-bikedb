@extends('layouts.auth')

@section('title', 'Thông tin cá nhân')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="p-4 border-b flex justify-between items-center">
            <h2 class="text-xl font-semibold">Thông tin cá nhân</h2>
            <button id="editBtn" class="bg-blue-600 text-white px-4 py-2 rounded flex items-center" style="background-color: green;">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Chỉnh sửa
            </button>
        </div>

        <!-- Form -->
        <form id="profileForm" method="POST" action="{{ route('profile.update') }}" class="p-6">
            @csrf
            @method('PUT')
            
            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <div class="p-2 border rounded bg-gray-50">{{ $user->email }}</div>
            </div>

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Họ và tên:</label>
                <span class="view-mode block p-2 border rounded bg-gray-50">{{ $user->name }}</span>
                <input name="name" type="text" value="{{ $user->name }}" 
                    class="edit-mode hidden w-full p-2 border rounded">
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Số điện thoại:</label>
                <span class="view-mode block p-2 border rounded bg-gray-50">{{ $user->phone ?? 'Chưa cập nhật' }}</span>
                <input name="phone" type="tel" value="{{ $user->phone }}" 
                    class="edit-mode hidden w-full p-2 border rounded">
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Địa chỉ:</label>
                <span class="view-mode block p-2 border rounded bg-gray-50">{{ $user->address ?? 'Chưa cập nhật' }}</span>
                <input name="address" type="text" value="{{ $user->address }}" 
                    class="edit-mode hidden w-full p-2 border rounded">
            </div>

            <!-- Birthday -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Ngày sinh:</label>
                <span class="view-mode block p-2 border rounded bg-gray-50">
                    {{ $user->birthday ? date('d/m/Y', strtotime($user->birthday)) : 'Chưa cập nhật' }}
                </span>
                <input name="birthday" type="date" value="{{ $user->birthday }}" 
                    class="edit-mode hidden w-full p-2 border rounded">
            </div>

            <!-- Gender -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Giới tính:</label>
                <span class="view-mode block p-2 border rounded bg-gray-50">{{ $user->gender ?? 'Chưa cập nhật' }}</span>
                <select name="gender" class="edit-mode hidden w-full p-2 border rounded">
                    <option value="">Chọn giới tính</option>
                    <option value="Nam" {{ $user->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                    <option value="Nữ" {{ $user->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="edit-mode hidden flex justify-end space-x-2 mt-6 pt-4 border-t">
                <button type="button" id="cancelBtn" 
                    class="px-4 py-2 bg-blue-600 text-white rounded" style="background-color: gray;">
                    Hủy
                </button>
                <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded" style="background-color: green;">
                    Lưu thay đổi
                </button>
            </div>
        </form>

        @if(session('success'))
            <div class="mx-6 mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mx-6 mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtn = document.getElementById('editBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const form = document.getElementById('profileForm');
    const viewModes = document.querySelectorAll('.view-mode');
    const editModes = document.querySelectorAll('.edit-mode');

    function toggleEditMode(show) {
        viewModes.forEach(el => el.classList.toggle('hidden', show));
        editModes.forEach(el => el.classList.toggle('hidden', !show));
        editBtn.classList.toggle('hidden', show);
    }

    editBtn.addEventListener('click', () => toggleEditMode(true));
    cancelBtn.addEventListener('click', () => {
        toggleEditMode(false);
        form.reset();
    });
});
</script>
@endpush
@endsection 