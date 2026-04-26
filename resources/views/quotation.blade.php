<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Request Quotation or Schedule Demo</title>
  <link rel="icon" type="image/png" href="{{ asset('logos/farmex.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: { primary: '#287e36' }
        }
      }
    }
  </script>
</head>
<body class="bg-slate-50 text-slate-900">
  <header class="bg-white border-b">
    <div class="container mx-auto px-4 h-16 flex items-center justify-between">
      <a href="/" class="flex items-center gap-3">
        <img src="https://farmex.extensionafrica.com/images/farmex-logo-main-with-tagline.png" class="w-32" alt="FarmEx">
      </a>
      <a href="/" class="text-sm hover:text-primary">Home</a>
    </div>
  </header>

  <main class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
      <div class="text-center mb-8">
        <span class="bg-primary text-white px-4 py-1 rounded-full text-sm">Contact</span>
        <h1 class="text-3xl md:text-4xl font-bold mt-4">Request a Quotation or Schedule a Demo</h1>
        <p class="text-slate-600 mt-3">Tell us about your needs and we will reach out.</p>
      </div>

      @if (session('status') === 'submitted')
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg mb-6">
          Your request has been received. We will contact you shortly.
        </div>
      @endif

      <div class="bg-white p-6 md:p-8 rounded-2xl shadow">
        <form action="{{ route('quotation.submit') }}" method="POST" class="space-y-6">
          @csrf
          <input type="hidden" name="request_type" value="{{ in_array($type, ['quote','demo','both']) ? $type : 'quote' }}">

          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium">Full Name</label>
              <input name="name" type="text" required class="mt-2 w-full border rounded-lg px-3 py-2" placeholder="Jane Doe" value="{{ old('name') }}">
              @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="block text-sm font-medium">Email</label>
              <input name="email" type="email" required class="mt-2 w-full border rounded-lg px-3 py-2" placeholder="jane@example.com" value="{{ old('email') }}">
              @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="block text-sm font-medium">Phone</label>
              <input name="phone" type="text" class="mt-2 w-full border rounded-lg px-3 py-2" placeholder="+234..." value="{{ old('phone') }}">
              @error('phone') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="block text-sm font-medium">Organization</label>
              <input name="company" type="text" class="mt-2 w-full border rounded-lg px-3 py-2" placeholder="Company or Program" value="{{ old('company') }}">
              @error('company') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium">What do you want to do?</label>
            <div class="mt-2 grid md:grid-cols-3 gap-3">
              <label class="flex items-center gap-2 border rounded-lg px-3 py-2">
                <input type="radio" name="request_type" value="quote" {{ old('request_type', $type) === 'quote' ? 'checked' : '' }}>
                <span>Request Quotation</span>
              </label>
              <label class="flex items-center gap-2 border rounded-lg px-3 py-2">
                <input type="radio" name="request_type" value="demo" {{ old('request_type', $type) === 'demo' ? 'checked' : '' }}>
                <span>Schedule Demo</span>
              </label>
              <label class="flex items-center gap-2 border rounded-lg px-3 py-2">
                <input type="radio" name="request_type" value="both" {{ old('request_type', $type) === 'both' ? 'checked' : '' }}>
                <span>Both</span>
              </label>
            </div>
            @error('request_type') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium">Preferred Date</label>
              <input name="preferred_date" type="date" class="mt-2 w-full border rounded-lg px-3 py-2" value="{{ old('preferred_date') }}">
              @error('preferred_date') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="block text-sm font-medium">Preferred Time</label>
              <input name="preferred_time" type="text" class="mt-2 w-full border rounded-lg px-3 py-2" placeholder="e.g., 10:00 AM WAT" value="{{ old('preferred_time') }}">
              @error('preferred_time') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium">Additional Details</label>
            <textarea name="message" rows="5" class="mt-2 w-full border rounded-lg px-3 py-2" placeholder="Share your objectives, scale, timelines, or questions">{{ old('message') }}</textarea>
            @error('message') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          <div class="flex gap-3">
            <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg font-medium">Submit Request</button>
            <a href="/" class="px-6 py-3 rounded-lg border">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </main>

  <footer class="border-t py-8 mt-12">
    <div class="container mx-auto px-4 flex justify-between items-center text-sm text-slate-500">
      <span>© {{ date('Y') }} FarmEx</span>
      <a href="/" class="hover:text-slate-800">Home</a>
    </div>
  </footer>
</body>
</html>
