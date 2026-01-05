<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmEx Software As A Service</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              DEFAULT: '#287e36',
              foreground: '#ffffff',
            },
            muted: {
              DEFAULT: '#f3f4f6',
              foreground: '#6b7280',
            },
            background: '#ffffff',
            foreground: '#0f172a',
          }
        }
      }
    }
  </script>
</head>
<body class="min-h-screen flex flex-col bg-background text-foreground">
  <!-- Header -->
  <header class="sticky top-0 z-50 w-full border-b bg-background/95 backdrop-blur">
    <div class="container mx-auto flex h-16 items-center justify-between px-4">
      <div class="flex items-center gap-2">
        <img src="https://staging.farmex.extensionafrica.com/images/farmex-logo-main-with-tagline.png" alt="" class="w-32">
     </div>
      <nav class="hidden md:flex gap-6">
        <a href="#features" class="text-sm font-medium text-muted-foreground transition-colors hover:text-primary">
          Features
        </a>
        <a href="#pricing" class="text-sm font-medium text-muted-foreground transition-colors hover:text-primary">
          Pricing
        </a>
        <a href="#testimonials" class="text-sm font-medium text-muted-foreground transition-colors hover:text-primary">
          Testimonials
        </a>
        <a href="#faq" class="text-sm font-medium text-muted-foreground transition-colors hover:text-primary">
          FAQ
        </a>
      </nav>
      <div class="flex items-center gap-4">
        <a href="/app/login" class="text-sm font-medium text-muted-foreground transition-colors hover:text-primary">
          Log in
        </a>
        <a href="#" class="inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90">
          Get Started
        </a>
      </div>
    </div>
  </header>

  <main class="flex-1">
    <!-- Hero Section -->
    <section class="w-full py-12 md:py-24 lg:py-32 xl:py-48">
      <div class="container mx-auto px-4 md:px-6">
        <div class="grid gap-6 lg:grid-cols-[1fr_400px] lg:gap-12 xl:grid-cols-[1fr_600px]">
          <div class="flex flex-col justify-center space-y-4">
            <div class="space-y-2">
              <h1 class="text-3xl font-bold tracking-tighter sm:text-5xl xl:text-6xl capitalize">
                Track All Activities at the last mile
              </h1>
              <p class="max-w-[600px] text-muted-foreground md:text-xl">
                The all-in-one platform that helps teams collaborate, manage projects, and deliver results faster.
              </p>
            </div>
            <div class="flex flex-col gap-2 min-[400px]:flex-row">
              <a href="#" class="inline-flex items-center justify-center rounded-md bg-primary px-8 py-3 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90">
                Start Free Trial
                <i class="ri-arrow-right-s-line ml-2"></i>
              </a>
              <a href="#" class="inline-flex items-center justify-center rounded-md border border-input bg-background px-8 py-3 text-sm font-medium shadow-sm hover:bg-muted">
                View Demo
              </a>
            </div>
            <div class="flex items-center gap-2 text-sm">
              <i class="ri-checkbox-circle-line text-primary"></i>
              <span>No credit card required</span>
            </div>
          </div>
          <img
            src="{{ asset('dashboard.avif') }}"
            alt="Dashboard Preview"
            class="mx-auto aspect-video overflow-hidden rounded-xl object-cover object-center sm:w-full lg:order-last"
          />
        </div>
      </div>
    </section>
    
    <!-- Features Section -->
    <section id="features" class="w-full py-12 md:py-24 lg:py-32 bg-muted/40">
      <div class="container mx-auto px-4 md:px-6">
        <div class="flex flex-col items-center justify-center space-y-4 text-center">
          <div class="space-y-2">
            <div class="inline-block rounded-lg bg-primary px-3 py-1 text-sm text-primary-foreground">
              Features
            </div>
            <h2 class="text-3xl font-bold tracking-tighter md:text-4xl">
              Everything you need to succeed
            </h2>
            <p class="max-w-[900px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
              FarmEx provides all the tools you need to streamline your workflow, collaborate with your team, and deliver results faster.
            </p>
          </div>
        </div>
        <div class="mx-auto grid max-w-5xl items-center gap-6 py-12 md:grid-cols-2 lg:grid-cols-3 lg:gap-12">
          <div class="flex flex-col items-center space-y-2 rounded-lg border p-6 shadow-sm">
            <div class="rounded-full bg-primary/10 p-3">
              <i class="ri-line-chart-line text-xl text-primary"></i>
            </div>
            <h3 class="text-xl font-bold">Analytics</h3>
            <p class="text-center text-muted-foreground">
              Gain valuable insights with powerful analytics and reporting tools.
            </p>
          </div>
          <div class="flex flex-col items-center space-y-2 rounded-lg border p-6 shadow-sm">
            <div class="rounded-full bg-primary/10 p-3">
              <i class="ri-shield-check-line text-xl text-primary"></i>
            </div>
            <h3 class="text-xl font-bold">Security</h3>
            <p class="text-center text-muted-foreground">
              Enterprise-grade security to keep your data safe and compliant.
            </p>
          </div>
          <div class="flex flex-col items-center space-y-2 rounded-lg border p-6 shadow-sm">
            <div class="rounded-full bg-primary/10 p-3">
              <i class="ri-flashlight-line text-xl text-primary"></i>
            </div>
            <h3 class="text-xl font-bold">Automation</h3>
            <p class="text-center text-muted-foreground">
              Automate repetitive tasks and focus on what matters most.
            </p>
          </div>
          <div class="flex flex-col items-center space-y-2 rounded-lg border p-6 shadow-sm">
            <div class="rounded-full bg-primary/10 p-3">
              <i class="ri-bank-card-line text-xl text-primary"></i>
            </div>
            <h3 class="text-xl font-bold">Billing</h3>
            <p class="text-center text-muted-foreground">
              Flexible billing options to fit your business needs.
            </p>
          </div>
          <div class="flex flex-col items-center space-y-2 rounded-lg border p-6 shadow-sm">
            <div class="rounded-full bg-primary/10 p-3">
              <i class="ri-customer-service-2-line text-xl text-primary"></i>
            </div>
            <h3 class="text-xl font-bold">Support</h3>
            <p class="text-center text-muted-foreground">
              24/7 support to help you succeed with our platform.
            </p>
          </div>
          <div class="flex flex-col items-center space-y-2 rounded-lg border p-6 shadow-sm">
            <div class="rounded-full bg-primary/10 p-3">
              <i class="ri-plug-line text-xl text-primary"></i>
            </div>
            <h3 class="text-xl font-bold">Integrations</h3>
            <p class="text-center text-muted-foreground">
              Connect with your favorite tools and services seamlessly.
            </p>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Pricing Section -->
    <section id="pricing" class="w-full py-12 md:py-24 lg:py-32">
      <div class="container mx-auto px-4 md:px-6">
        <div class="flex flex-col items-center justify-center space-y-4 text-center">
          <div class="space-y-2">
            <div class="inline-block rounded-lg bg-primary px-3 py-1 text-sm text-primary-foreground">
              Pricing
            </div>
            <h2 class="text-3xl font-bold tracking-tighter md:text-4xl">
              Simple, transparent pricing
            </h2>
            <p class="max-w-[600px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
              Choose the plan that's right for you and start your 14-day free trial today.
            </p>
          </div>
        </div>
        
        <div class="mx-auto mt-8 max-w-5xl">
          <div class="flex justify-center mb-8">
            <div class="inline-flex h-10 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground">
              <button class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium bg-background text-foreground shadow-sm" id="monthly-tab">Monthly</button>
              <button class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium" id="annual-tab">Annually (Save 20%)</button>
            </div>
          </div>
          
          <!-- Monthly Pricing -->
          <div id="monthly-pricing" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
              <div class="p-6 space-y-2">
                <h3 class="text-2xl font-bold">Starter</h3>
                <p class="text-sm text-muted-foreground">Perfect for individuals and small teams.</p>
                <div class="mt-4 flex items-baseline text-5xl font-bold">
                  $29<span class="ml-1 text-xl font-normal text-muted-foreground">/month</span>
                </div>
              </div>
              <div class="p-6 pt-0">
                <ul class="space-y-2">
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Up to 5 team members</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>10 projects</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Basic analytics</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>24-hour support response time</span>
                  </li>
                </ul>
              </div>
              <div class="p-6 pt-0">
                <a href="#" class="inline-flex w-full items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90">
                  Start Free Trial
                </a>
              </div>
            </div>
            
            <div class="rounded-lg border-2 border-primary bg-card text-card-foreground shadow-sm">
              <div class="p-6 space-y-2">
                <div class="mb-2 rounded-full bg-primary/10 px-3 py-1 text-xs font-medium text-primary w-fit mx-auto">
                  Most Popular
                </div>
                <h3 class="text-2xl font-bold">Professional</h3>
                <p class="text-sm text-muted-foreground">Perfect for growing teams and businesses.</p>
                <div class="mt-4 flex items-baseline text-5xl font-bold">
                  $79<span class="ml-1 text-xl font-normal text-muted-foreground">/month</span>
                </div>
              </div>
              <div class="p-6 pt-0">
                <ul class="space-y-2">
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Up to 20 team members</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Unlimited projects</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Advanced analytics</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>4-hour support response time</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Custom integrations</span>
                  </li>
                </ul>
              </div>
              <div class="p-6 pt-0">
                <a href="#" class="inline-flex w-full items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90">
                  Start Free Trial
                </a>
              </div>
            </div>
            
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
              <div class="p-6 space-y-2">
                <h3 class="text-2xl font-bold">Enterprise</h3>
                <p class="text-sm text-muted-foreground">For large organizations with specific needs.</p>
                <div class="mt-4 flex items-baseline text-5xl font-bold">
                  $199<span class="ml-1 text-xl font-normal text-muted-foreground">/month</span>
                </div>
              </div>
              <div class="p-6 pt-0">
                <ul class="space-y-2">
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Unlimited team members</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Unlimited projects</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Custom analytics</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>1-hour support response time</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Dedicated account manager</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Custom contract</span>
                  </li>
                </ul>
              </div>
              <div class="p-6 pt-0">
                <a href="#" class="inline-flex w-full items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90">
                  Contact Sales
                </a>
              </div>
            </div>
          </div>
          
          <!-- Annual Pricing (Hidden by Default) -->
          <div id="annual-pricing" class="hidden grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
              <div class="p-6 space-y-2">
                <h3 class="text-2xl font-bold">Starter</h3>
                <p class="text-sm text-muted-foreground">Perfect for individuals and small teams.</p>
                <div class="mt-4 flex items-baseline text-5xl font-bold">
                  $23<span class="ml-1 text-xl font-normal text-muted-foreground">/month</span>
                </div>
              </div>
              <div class="p-6 pt-0">
                <ul class="space-y-2">
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Up to 5 team members</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>10 projects</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Basic analytics</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>24-hour support response time</span>
                  </li>
                </ul>
              </div>
              <div class="p-6 pt-0">
                <a href="#" class="inline-flex w-full items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90">
                  Start Free Trial
                </a>
              </div>
            </div>
            
            <div class="rounded-lg border-2 border-primary bg-card text-card-foreground shadow-sm">
              <div class="p-6 space-y-2">
                <div class="mb-2 rounded-full bg-primary/10 px-3 py-1 text-xs font-medium text-primary w-fit mx-auto">
                  Most Popular
                </div>
                <h3 class="text-2xl font-bold">Professional</h3>
                <p class="text-sm text-muted-foreground">Perfect for growing teams and businesses.</p>
                <div class="mt-4 flex items-baseline text-5xl font-bold">
                  $63<span class="ml-1 text-xl font-normal text-muted-foreground">/month</span>
                </div>
              </div>
              <div class="p-6 pt-0">
                <ul class="space-y-2">
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Up to 20 team members</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Unlimited projects</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Advanced analytics</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>4-hour support response time</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Custom integrations</span>
                  </li>
                </ul>
              </div>
              <div class="p-6 pt-0">
                <a href="#" class="inline-flex w-full items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90">
                  Start Free Trial
                </a>
              </div>
            </div>
            
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
              <div class="p-6 space-y-2">
                <h3 class="text-2xl font-bold">Enterprise</h3>
                <p class="text-sm text-muted-foreground">For large organizations with specific needs.</p>
                <div class="mt-4 flex items-baseline text-5xl font-bold">
                  $159<span class="ml-1 text-xl font-normal text-muted-foreground">/month</span>
                </div>
              </div>
              <div class="p-6 pt-0">
                <ul class="space-y-2">
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Unlimited team members</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Unlimited projects</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Custom analytics</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>1-hour support response time</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Dedicated account manager</span>
                  </li>
                  <li class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-line text-primary"></i>
                    <span>Custom contract</span>
                  </li>
                </ul>
              </div>
              <div class="p-6 pt-0">
                <a href="#" class="inline-flex w-full items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90">
                  Contact Sales
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Testimonials Section -->
    <section id="testimonials" class="w-full py-12 md:py-24 lg:py-32 bg-muted/40">
      <div class="container mx-auto px-4 md:px-6">
        <div class="flex flex-col items-center justify-center space-y-4 text-center">
          <div class="space-y-2">
            <div class="inline-block rounded-lg bg-primary px-3 py-1 text-sm text-primary-foreground">
              Testimonials
            </div>
            <h2 class="text-3xl font-bold tracking-tighter md:text-4xl">
              Trusted by thousands of companies
            </h2>
            <p class="max-w-[600px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
              See what our customers have to say about SaaSly.
            </p>
          </div>
        </div>
        <div class="mx-auto grid max-w-5xl gap-6 py-12 lg:grid-cols-2 lg:gap-12">
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="p-6">
              <div class="flex flex-col gap-4">
                <div class="flex gap-1">
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                </div>
                <p class="text-lg">
                  "SaaSly has transformed how our team works together. The analytics and automation features have saved us countless hours."
                </p>
                <div class="flex items-center gap-4">
                  <img
                    src="https://placehold.co/40x40/f5f5f5/cccccc"
                    alt="Avatar"
                    class="rounded-full"
                  />
                  <div>
                    <p class="font-semibold">Sarah Johnson</p>
                    <p class="text-sm text-muted-foreground">CTO, TechCorp</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="p-6">
              <div class="flex flex-col gap-4">
                <div class="flex gap-1">
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                </div>
                <p class="text-lg">
                  "The customer support is exceptional. Any time we've had an issue, the team has been quick to respond and resolve it."
                </p>
                <div class="flex items-center gap-4">
                  <img
                    src="https://placehold.co/40x40/f5f5f5/cccccc"
                    alt="Avatar"
                    class="rounded-full"
                  />
                  <div>
                    <p class="font-semibold">Michael Chen</p>
                    <p class="text-sm text-muted-foreground">Product Manager, Innovate Inc</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="p-6">
              <div class="flex flex-col gap-4">
                <div class="flex gap-1">
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                </div>
                <p class="text-lg">
                  "We've been able to scale our operations without adding more staff, thanks to SaaSly's automation capabilities."
                </p>
                <div class="flex items-center gap-4">
                  <img
                    src="https://placehold.co/40x40/f5f5f5/cccccc"
                    alt="Avatar"
                    class="rounded-full"
                  />
                  <div>
                    <p class="font-semibold">Emily Rodriguez</p>
                    <p class="text-sm text-muted-foreground">Operations Director, GrowFast</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="p-6">
              <div class="flex flex-col gap-4">
                <div class="flex gap-1">
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                  <i class="ri-star-fill text-primary"></i>
                </div>
                <p class="text-lg">
                  "The integrations with our existing tools made adoption seamless. Our team was up and running in no time."
                </p>
                <div class="flex items-center gap-4">
                  <img
                    src="https://placehold.co/40x40/f5f5f5/cccccc"
                    alt="Avatar"
                    class="rounded-full"
                  />
                  <div>
                    <p class="font-semibold">David Kim</p>
                    <p class="text-sm text-muted-foreground">IT Manager, Enterprise Solutions</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- FAQ Section -->
    <section id="faq" class="w-full py-12 md:py-24 lg:py-32">
      <div class="container mx-auto px-4 md:px-6">
        <div class="flex flex-col items-center justify-center space-y-4 text-center">
          <div class="space-y-2">
            <div class="inline-block rounded-lg bg-primary px-3 py-1 text-sm text-primary-foreground">
              FAQ
            </div>
            <h2 class="text-3xl font-bold tracking-tighter md:text-4xl">
              Frequently asked questions
            </h2>
            <p class="max-w-[600px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
              Find answers to common questions about FarmEx.
            </p>
          </div>
        </div>
        <div class="mx-auto max-w-3xl space-y-4 py-8">
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="p-6">
              <h3 class="text-lg font-semibold">How does the 14-day free trial work?</h3>
              <p class="mt-2">
                Our 14-day free trial gives you full access to all features of your selected plan. No credit card is required to start, and you can cancel anytime. At the end of the trial, you can choose to subscribe or your account will automatically downgrade to our free tier with limited features.
              </p>
            </div>
          </div>
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="p-6">
              <h3 class="text-lg font-semibold">Can I change my plan later?</h3>
              <p class="mt-2">
                Yes, you can upgrade or downgrade your plan at any time. When upgrading, the new features will be available immediately. If you downgrade, the changes will take effect at the start of your next billing cycle.
              </p>
            </div>
          </div>
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="p-6">
              <h3 class="text-lg font-semibold">Is there a limit to how many team members I can add?</h3>
              <p class="mt-2">
                The number of team members you can add depends on your plan. The Starter plan allows up to 5 team members, the Professional plan allows up to 20, and the Enterprise plan has unlimited team members.
              </p>
            </div>
          </div>
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="p-6">
              <h3 class="text-lg font-semibold">How secure is my data?</h3>
              <p class="mt-2">
                We take security seriously. All data is encrypted both in transit and at rest. We use industry-standard security practices and regularly undergo security audits. Our platform is compliant with GDPR, HIPAA, and other relevant regulations.
              </p>
            </div>
          </div>
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="p-6">
              <h3 class="text-lg font-semibold">What kind of support do you offer?</h3>
              <p class="mt-2">
                All plans include email support with varying response times based on your plan. The Enterprise plan includes a dedicated account manager. We also have an extensive knowledge base and community forum available to all users.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- CTA Section -->
    <section class="w-full py-12 md:py-24 lg:py-32 bg-primary text-primary-foreground">
      <div class="container mx-auto px-4 md:px-6">
        <div class="flex flex-col items-center justify-center space-y-4 text-center">
          <div class="space-y-2">
            <h2 class="text-3xl font-bold tracking-tighter md:text-4xl">
              Ready to transform your workflow?
            </h2>
            <p class="mx-auto max-w-[600px] md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
              Join thousands of teams already using SaaSly to streamline their operations.
            </p>
          </div>
          <div class="flex flex-col gap-2 min-[400px]:flex-row">
            <a href="#" class="inline-flex items-center justify-center rounded-md bg-white px-8 py-3 text-sm font-medium text-primary shadow transition-colors hover:bg-white/90">
              Start Free Trial
            </a>
            <a href="#" class="inline-flex items-center justify-center rounded-md border border-primary-foreground bg-transparent px-8 py-3 text-sm font-medium text-primary-foreground shadow-sm hover:bg-primary-foreground/10">
              Schedule Demo
            </a>
          </div>
        </div>
      </div>
    </section>
  </main>
  
  <!-- Footer -->
  <footer class="w-full border-t bg-background py-6 md:py-12">
    <div class="container mx-auto flex flex-col items-center justify-center gap-4 px-4 md:px-6 md:flex-row md:justify-between">
      <div class="flex items-center gap-2">
        <i class="ri-flashlight-line text-xl"></i>
        <span class="text-lg font-bold">FarmEx</span>
      </div>
      <div class="flex gap-4">
        <a href="#" class="text-sm text-muted-foreground hover:text-foreground">
          Terms
        </a>
        <a href="#" class="text-sm text-muted-foreground hover:text-foreground">
          Privacy
        </a>
        <a href="#" class="text-sm text-muted-foreground hover:text-foreground">
          Cookies
        </a>
      </div>
      <p class="text-sm text-muted-foreground">
        &copy; <script>document.write(new Date().getFullYear())</script> FarmEx, Inc. All rights reserved.
      </p>
    </div>
  </footer>

  <!-- Simple JavaScript for tab switching -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const monthlyTab = document.getElementById('monthly-tab');
      const annualTab = document.getElementById('annual-tab');
      const monthlyPricing = document.getElementById('monthly-pricing');
      const annualPricing = document.getElementById('annual-pricing');
      
      monthlyTab.addEventListener('click', function() {
        monthlyTab.classList.add('bg-background', 'text-foreground', 'shadow-sm');
        annualTab.classList.remove('bg-background', 'text-foreground', 'shadow-sm');
        monthlyPricing.classList.remove('hidden');
        annualPricing.classList.add('hidden');
      });
      
      annualTab.addEventListener('click', function() {
        annualTab.classList.add('bg-background', 'text-foreground', 'shadow-sm');
        monthlyTab.classList.remove('bg-background', 'text-foreground', 'shadow-sm');
        annualPricing.classList.remove('hidden');
        monthlyPricing.classList.add('hidden');
      });
    });
  </script>
</body>
</html>