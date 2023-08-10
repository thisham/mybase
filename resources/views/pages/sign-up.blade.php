<x-layouts.guest title="Sign Up">
    <div class="w-[32rem] flex mx-auto">
        <div class="card">
            <h1 class="mb-8">Sign Up</h1>

            <form action="{{ route('auth.sign-up') }}" method="post">
                @csrf

                <div class="field-group">
                    <label for="name">Name</label>
                    <input type="name" name="name" id="name" />
                    @error('name')
                        <small class="text-danger-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" />
                    @error('email')
                        <small class="text-danger-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" />
                    @error('password')
                        <small class="text-danger-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" />
                    @error('password_confirmation')
                        <small class="text-danger-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group mt-4">
                    <button type="submit" class="clickable primary">
                        Sign Up
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.guest>
