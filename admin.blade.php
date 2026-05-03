<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/favicon.png" />
    <style>
        body {
            font-family: 'Playfair Display', serif;
            background-color: #fdfbf7;
            color: #4a3f35;
        }
    </style>
</head>

<body class="antialiased min-h-screen">

    @if(!session('is_admin'))
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white p-8 md:p-12 rounded-3xl shadow-xl border border-gray-100 max-w-md w-full text-center">
            <h2 class="text-3xl font-bold text-[#c2a373] mb-2">Admin Access</h2>
            <p class="text-gray-500 mb-8 text-sm">Enter your secret code to continue</p>

            @if(session('error'))
            <p class="text-red-500 mb-4 text-sm">{{ session('error') }}</p>
            @endif

            <form action="/admin/login" method="POST">
                @csrf
                <input type="password" name="code" placeholder="Enter Secret Code" class="w-full text-center tracking-widest px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#c2a373] focus:ring-1 focus:ring-[#c2a373] mb-6">
                <button type="submit" class="w-full bg-[#c2a373] text-white py-3 rounded-lg hover:bg-[#a6885b] transition font-semibold tracking-wider">UNLOCK</button>
            </form>
        </div>
    </div>
    @else
    <nav class="bg-white shadow-sm border-b border-gray-100 px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-[#c2a373]">Wedding RSVP Admin</h1>
        <form action="/admin/logout" method="POST">
            @csrf
            <button type="submit" class="text-sm font-semibold text-gray-500 hover:text-red-500 transition">Logout</button>
        </form>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 text-center">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm mb-1">Total Guests</p>
                <p class="text-3xl font-bold">{{ $totalGuests }}</p>
            </div>
            <div class="bg-green-50 p-6 rounded-2xl shadow-sm border border-green-100">
                <p class="text-green-600 text-sm mb-1">Accepted</p>
                <p class="text-3xl font-bold text-green-700">{{ $accepted }}</p>
            </div>
            <div class="bg-red-50 p-6 rounded-2xl shadow-sm border border-red-100">
                <p class="text-red-600 text-sm mb-1">Declined</p>
                <p class="text-3xl font-bold text-red-700">{{ $declined }}</p>
            </div>
            <div class="bg-orange-50 p-6 rounded-2xl shadow-sm border border-orange-100">
                <p class="text-orange-600 text-sm mb-1">Pending</p>
                <p class="text-3xl font-bold text-orange-700">{{ $pending }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 mb-6">
            <form action="/admin" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
                <div class="w-full md:flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or phone number..." class="w-full px-4 py-2.5 border rounded-lg focus:border-[#c2a373] outline-none bg-gray-50 text-sm">
                </div>
                <div class="w-full md:w-48">
                    <select name="status" class="w-full px-4 py-2.5 border rounded-lg focus:border-[#c2a373] outline-none bg-gray-50 text-sm cursor-pointer">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Statuses</option>
                        <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="declined" {{ request('status') == 'declined' ? 'selected' : '' }}>Declined</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="w-full md:w-auto flex gap-2">
                    <button type="submit" class="flex-1 md:flex-none bg-gray-800 text-white px-6 py-2.5 rounded-lg hover:bg-gray-700 transition font-semibold text-sm">Search</button>

                    @if(request('search') || (request('status') && request('status') != 'all'))
                    <a href="/admin" class="flex-1 md:flex-none text-center bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-300 transition font-semibold text-sm">Clear</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
            <h3 class="text-xl font-bold mb-4">Add New Guest</h3>

            @if(session('success'))
            <div id="success-alert" class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm transition-opacity duration-500">{{ session('success') }}</div>
            @endif
            @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm">{{ $errors->first() }}</div>
            @endif

            <form action="/admin/guest" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                @csrf
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm text-gray-600 mb-1">Name</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:border-[#c2a373] outline-none">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Phone Number</label>
                    <input type="text" name="phone" required class="w-full px-4 py-2 border rounded-lg focus:border-[#c2a373] outline-none" placeholder="07XXXXXXXX">
                </div>
                <div>
                    <button type="submit" class="w-full bg-[#c2a373] text-white py-2 px-4 rounded-lg hover:bg-[#a6885b] font-semibold">Add Guest</button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 text-sm">
                            <th class="p-4 font-semibold">Name</th>
                            <th class="p-4 font-semibold">Phone</th>
                            <th class="p-4 font-semibold">Status</th>
                            <th class="p-4 font-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guests as $guest)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                            <td class="p-4 font-medium">{{ $guest->name }}</td>
                            <td class="p-4 text-gray-600">{{ $guest->phone }}</td>
                            <td class="p-4">
                                @if($guest->status == 'accepted')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Accepted</span>
                                @elseif($guest->status == 'declined')
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Declined</span>
                                @else
                                <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Pending</span>
                                @endif
                            </td>
                            <td class="p-4 text-center flex items-center justify-center gap-2">

                                <button onclick="sendWhatsApp('{{ $guest->phone }}', '{{ $guest->name }}')" class="bg-[#25D366]/10 text-[#25D366] p-2 rounded-lg hover:bg-[#25D366] hover:text-white transition" title="Send Invite">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                    </svg>
                                </button>

                                <button onclick="openEditModal('{{ $guest->id }}', '{{ $guest->name }}', '{{ $guest->phone }}', '{{ $guest->status }}')" class="bg-blue-100 text-blue-600 p-2 rounded-lg hover:bg-blue-200 transition" title="Edit Guest">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </button>

                                <form action="/admin/guest/delete/{{ $guest->id }}" method="POST" onsubmit="return confirm('Are you sure you want to completely remove this guest?');" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200 transition" title="Delete Guest">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach

                        @if($guests->isEmpty())
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-400">No guests found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="editModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-opacity">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl transform scale-100 transition-transform">
            <h3 class="text-2xl font-bold text-[#c2a373] mb-6">Edit Guest Details</h3>

            <form id="editForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm text-gray-600 mb-1">Name</label>
                    <input type="text" name="name" id="edit_name" required class="w-full px-4 py-2 border rounded-lg focus:border-[#c2a373] outline-none">
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-gray-600 mb-1">Phone Number</label>
                    <input type="text" name="phone" id="edit_phone" required class="w-full px-4 py-2 border rounded-lg focus:border-[#c2a373] outline-none">
                </div>

                <div class="mb-8">
                    <label class="block text-sm text-gray-600 mb-1">RSVP Status</label>
                    <select name="status" id="edit_status" class="w-full px-4 py-2 border rounded-lg focus:border-[#c2a373] outline-none bg-gray-50">
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="declined">Declined</option>
                    </select>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="px-5 py-2 bg-gray-100 text-gray-600 rounded-lg font-semibold hover:bg-gray-200 transition">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-[#c2a373] text-white rounded-lg font-semibold hover:bg-[#a6885b] transition">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Success Message Fade Out
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.opacity = '0';
                    setTimeout(() => {
                        successAlert.style.display = 'none';
                    }, 500);
                }, 2000);
            }
        });

        // Edit Modal Open
        function openEditModal(id, name, phone, status) {
            document.getElementById('editForm').action = '/admin/guest/update/' + id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_phone').value = phone;
            document.getElementById('edit_status').value = status;

            const modal = document.getElementById('editModal');
            modal.classList.remove('hidden');
        }

        // Edit Modal Close
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // WhatsApp Message (English - Updated Format)
        function sendWhatsApp(phone, name) {
            let formattedPhone = phone.trim();
            if (formattedPhone.startsWith('0')) {
                formattedPhone = '94' + formattedPhone.substring(1);
            }

            const siteLink = window.location.origin;

            // ඔයා ඉල්ලපු අලුත් Format එක
            const message = `✨ *Timeless Love – Vintage Elegance* ✨\n\nWe joyfully invite *${name}* to celebrate our wedding day! 💍🕊️\nYour presence means the world to us.\n\nKindly view invitation below:\n\n${siteLink}\n\n_(Please be kind enough to visit the website, enter your whatsapp number and RSVP by 10th of May.)_\n\nWith love,\nDasuni & Shanka 💛`;

            const encodedMessage = encodeURIComponent(message);
            const waUrl = `https://wa.me/${formattedPhone}?text=${encodedMessage}`;

            window.open(waUrl, '_blank');
        }
    </script>
    @endif
</body>

</html>