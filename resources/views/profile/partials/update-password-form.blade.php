<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-6">
            <div>
                <label for="update_password_current_password" class="block text-sm font-semibold text-gray-900 mb-2">
                    {{ __('Kata Sandi Saat Ini') }}
                </label>
                <div class="relative">
                    <input id="update_password_current_password" 
                           name="current_password" 
                           type="password" 
                           class="w-full px-4 py-3 text-gray-900 bg-white border-2 border-gray-200 rounded-2xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-200 placeholder-gray-400 shadow-sm" 
                           autocomplete="current-password"
                           placeholder="Masukkan kata sandi saat ini">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
                @if($errors->updatePassword->get('current_password'))
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $errors->updatePassword->get('current_password')[0] }}
                    </p>
                @endif
            </div>

            <div>
                <label for="update_password_password" class="block text-sm font-semibold text-gray-900 mb-2">
                    {{ __('Kata Sandi Baru') }}
                </label>
                <div class="relative">
                    <input id="update_password_password" 
                           name="password" 
                           type="password" 
                           class="w-full px-4 py-3 text-gray-900 bg-white border-2 border-gray-200 rounded-2xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-200 placeholder-gray-400 shadow-sm" 
                           autocomplete="new-password"
                           placeholder="Masukkan kata sandi baru">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                </div>
                @if($errors->updatePassword->get('password'))
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $errors->updatePassword->get('password')[0] }}
                    </p>
                @endif
                <div class="mt-2">
                    <div class="text-xs text-gray-500">
                        <p class="mb-1">Kata sandi harus mengandung:</p>
                        <ul class="list-disc list-inside space-y-1 ml-2">
                            <li>Minimal 8 karakter</li>
                            <li>Kombinasi huruf besar dan kecil</li>
                            <li>Minimal 1 angka</li>
                            <li>Minimal 1 simbol khusus</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div>
                <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-900 mb-2">
                    {{ __('Konfirmasi Kata Sandi Baru') }}
                </label>
                <div class="relative">
                    <input id="update_password_password_confirmation" 
                           name="password_confirmation" 
                           type="password" 
                           class="w-full px-4 py-3 text-gray-900 bg-white border-2 border-gray-200 rounded-2xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-200 placeholder-gray-400 shadow-sm" 
                           autocomplete="new-password"
                           placeholder="Konfirmasi kata sandi baru">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                @if($errors->updatePassword->get('password_confirmation'))
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $errors->updatePassword->get('password_confirmation')[0] }}
                    </p>
                @endif
            </div>
        </div>

        <div class="flex items-center justify-between pt-6 border-t border-gray-100">
            <div class="flex items-center">
                @if (session('status') === 'password-updated')
                    <div x-data="{ show: true }" 
                         x-show="show" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-90"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         x-init="setTimeout(() => show = false, 3000)"
                         class="flex items-center px-4 py-2 text-sm text-green-700 bg-green-100 rounded-2xl">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Kata sandi berhasil diperbarui!') }}
                    </div>
                @endif
            </div>
            <button type="submit" 
                    class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-amber-600 to-orange-600 rounded-2xl hover:from-amber-700 hover:to-orange-700 focus:outline-none focus:ring-4 focus:ring-amber-500/20 transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                {{ __('Perbarui Kata Sandi') }}
            </button>
        </div>
    </form>
</section>
