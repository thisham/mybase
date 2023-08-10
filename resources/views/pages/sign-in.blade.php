<x-layouts.guest title="Sign In">
    <div class="w-[32rem] flex mx-auto">
        <div class="card">
            <h1 class="mb-8">Sign In</h1>

            <form action="{{ route('auth.sign-in') }}" method="post">
                @csrf

                <div class="field-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" />
                </div>

                <div class="field-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" />
                </div>

                <div class="field-group mt-4">
                    <button type="submit" class="clickable primary">
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.guest>
