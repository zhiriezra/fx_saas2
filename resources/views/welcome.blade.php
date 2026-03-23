<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FarmEx – Last-mile Operations Platform</title>

  <link rel="icon" type="image/png" href="{{ asset('logos/farmex.png') }}">

  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#287e36',
          }
        }
      }
    }
  </script>

  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

  <style>
    html {
      scroll-behavior: smooth;
    }
    
    /* Smooth transition for section appearances */
    section {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 0.6s ease-out forwards;
    }
    
    section:nth-child(2) { animation-delay: 0.1s; }
    section:nth-child(3) { animation-delay: 0.2s; }
    section:nth-child(4) { animation-delay: 0.3s; }
    section:nth-child(5) { animation-delay: 0.4s; }
    section:nth-child(6) { animation-delay: 0.5s; }
    
    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body class="bg-white text-slate-900 flex flex-col min-h-screen">

<!-- ================= HEADER ================= -->
<header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b">
  <div class="container mx-auto px-4 h-16 flex items-center justify-between">
    <img src="https://farmex.extensionafrica.com/images/farmex-logo-main-with-tagline.png" class="w-32" alt="FarmEx">

    <nav class="hidden md:flex gap-6 text-sm">
      <a href="#features" class="hover:text-primary">Features</a>
      <a href="#benefits" class="hover:text-primary">Benefits</a>
      <a href="#testimonials" class="hover:text-primary">Testimonials</a>
      <a href="#faq" class="hover:text-primary">FAQ</a>
    </nav>

    <div class="flex items-center gap-4">
      <a href="/app/login" class="text-sm hover:text-primary">Log in</a>
      <a href="/quotation"
         class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium shadow hover:bg-primary/90">
        Quotation
      </a>
    </div>
  </div>
</header>

<main class="flex-1">

<!-- ================= HERO ================= -->
<section class="relative overflow-hidden">
  <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-white to-white"></div>

  <div class="relative container mx-auto px-4 pt-24 pb-32">
    <div class="grid lg:grid-cols-2 gap-14 items-center">

      <div class="space-y-6">
        <!-- <span class="inline-block bg-primary/10 text-primary px-4 py-1 rounded-full text-sm">
          Built for last-mile operations
        </span> -->

        <h1 class="text-4xl sm:text-5xl xl:text-6xl font-extrabold tracking-tight">
          Track and manage<br class="hidden sm:block">
          field activities in real time
        </h1>

        <p class="text-lg text-slate-600 max-w-xl">
          FarmEx helps organizations coordinate teams, capture field data,
          and monitor operations from one powerful dashboard.
        </p>

        <div class="flex flex-wrap gap-3">
          <a href="/quotation?type=quote"
             class="bg-primary text-white px-8 py-3 rounded-lg font-medium shadow-lg hover:bg-primary/90">
            Request Quotation
          </a>

          <a href="/quotation?type=demo"
             class="border border-primary/30 px-8 py-3 rounded-lg font-medium hover:bg-primary/10">
            Schedule Demo
          </a>
        </div>

        <!-- <div class="flex items-center gap-2 text-sm text-slate-500">
          <i class="ri-checkbox-circle-line text-primary"></i>
          No credit card required
        </div> -->
      </div>

      <div>
        <img src="{{ asset('dashboard.avif') }}"
             class="rounded-2xl shadow-2xl"
             alt="FarmEx dashboard">
      </div>

    </div>
  </div>
</section>

<!-- ================= FEATURES ================= -->
<section id="features" class="py-24 bg-slate-50">
  <div class="container mx-auto px-4">

    <div class="text-center mb-14">
      <span class="bg-primary text-white px-4 py-1 rounded-full text-sm">Features</span>
      <h2 class="text-3xl md:text-4xl font-bold mt-4">
        Everything you need to operate at scale
      </h2>
      <p class="text-slate-600 max-w-2xl mx-auto mt-3">
        Designed for teams working on the ground, in real environments, with real data.
      </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">

      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition">
        <i class="ri-line-chart-line text-primary text-3xl"></i>
        <h3 class="font-semibold text-xl mt-4">Analytics</h3>
        <p class="text-slate-600 mt-2">
          Monitor performance and outcomes with live dashboards and reports.
        </p>
      </div>

      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition">
        <i class="ri-map-2-line text-primary text-3xl"></i>
        <h3 class="font-semibold text-xl mt-4">Farm Seasons</h3>
        <p class="text-slate-600 mt-2">
          Track land usage and visitations to optimize resource allocation. As well as track linked farm demonstration plots to projects and crops.
        </p>
      </div>

      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition">
        <i class="ri-earth-line text-primary text-3xl"></i>
        <h3 class="font-semibold text-xl mt-4">Training & M&E</h3>
        <p class="text-slate-600 mt-2">
          Tack training sessions and attendance as well as Monitoring & Evaluation reports 
        </p>
      </div>

      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition">
        <i class="ri-group-2-line text-primary text-3xl"></i>
        <h3 class="font-semibold text-xl mt-4">Agents and Farmers</h3>
        <p class="text-slate-600 mt-2">
          Manage field agents and farmers with ease, track their activities, assigned tasks and aggregation centers (commodity collected).
        </p>
      </div>

      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition">
        <i class="ri-funds-line text-primary text-3xl"></i>
        <h3 class="font-semibold text-xl mt-4">Sales & Distribution</h3>
        <p class="text-slate-600 mt-2">
          Track Vendors products and orders as well as sales performances.Also track weekly commodity pricing and competitor product.
        </p>
      </div>

    </div>
  </div>
</section>

<!-- ================= BENEFITS ================= -->
<section id="benefits" class="py-24 bg-slate-50">
  <div class="container mx-auto px-4">

    <div class="text-center mb-14">
      <span class="bg-primary text-white px-4 py-1 rounded-full text-sm">Benefits</span>
      <h2 class="text-3xl md:text-4xl font-bold mt-4">
        Why choose FarmEx?
      </h2>
      <p class="text-slate-600 max-w-2xl mx-auto mt-3">
        Choose only the services you need and scale as you grow.
      </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">

      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition">
        <i class="ri-timer-flash-line text-primary text-3xl"></i>
        <h3 class="font-semibold text-xl mt-4">Real‑Time Operational Visibility</h3>
        <p class="text-slate-600 mt-2">
          Live dashboards and KPIs (orders, revenue, penetration, retention, product diversity) to monitor performance and outcomes in real-time.
        </p>
      </div>

      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition">
        <i class="ri-drag-move-line text-primary text-3xl"></i>
        <h3 class="font-semibold text-xl mt-4">Efficiency and Automation</h3>
        <p class="text-slate-600 mt-2">
          Centralized capture of field data (farms, seasons, trainings, aggregations) reduces manual reporting and reconciliation 
        </p>
      </div>

      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition">
        <i class="ri-database-line text-primary text-3xl"></i>
        <h3 class="font-semibold text-xl mt-4">Data‑Driven Decision Making</h3>
        <p class="text-slate-600 mt-2">
          Market intelligence (commodity pricing, competitor products) informs procurement, pricing, and channel strategies  
        </p>
      </div>

      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition">
        <i class="ri-secure-payment-line text-primary text-3xl"></i>
        <h3 class="font-semibold text-xl mt-4">Secure and Governed Access</h3>
        <p class="text-slate-600 mt-2">
          Robust middleware and role‑based panel access protect sensitive data and align with governance needs 
        </p>
      </div>

      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition">
        <i class="ri-bar-chart-line text-primary text-3xl"></i>
        <h3 class="font-semibold text-xl mt-4">Analytics Highlights</h3>
        <p class="text-slate-600 mt-2">
          Revenue and Order Insights: totals, averages, unique farmers/agents, retention rates, market penetration; per location rollups 
        </p>
      </div>

    </div>
  </div>
</section>

<!-- ================= TESTIMONIALS ================= -->
<section id="testimonials" class="py-24 bg-slate-50">
  <div class="container mx-auto px-4">

    <div class="text-center mb-12">
      <span class="bg-primary text-white px-4 py-1 rounded-full text-sm">
        Testimonials
      </span>
      <h2 class="text-3xl md:text-4xl font-bold mt-4">
        Trusted by growing organizations
      </h2>
    </div>

    <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">

      <div class="bg-white p-8 rounded-2xl shadow-md">
        <p class="italic text-lg">
          “FarmEx completely changed how we monitor field activities.”
        </p>
        <p class="mt-4 font-semibold">Sarah Johnson</p>
        <p class="text-sm text-slate-500">Operations Lead</p>
      </div>

      <div class="bg-white p-8 rounded-2xl shadow-md">
        <p class="italic text-lg">
          “The automation alone saves us hours every week.”
        </p>
        <p class="mt-4 font-semibold">Michael Chen</p>
        <p class="text-sm text-slate-500">Program Manager</p>
      </div>

    </div>
  </div>
</section>

<!-- ================= FAQ ================= -->
<section id="faq" class="py-24">
  <div class="container mx-auto px-4 max-w-3xl">

    <h2 class="text-3xl font-bold text-center mb-10">
      Frequently asked questions
    </h2>

    <div class="space-y-6">

      <div class="bg-white p-6 rounded-xl shadow-sm">
        <h3 class="font-semibold">Is the free trial really free?</h3>
        <p class="text-slate-600 mt-2">
          Yes. No credit card required. Cancel anytime.
        </p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-sm">
        <h3 class="font-semibold">Can I upgrade later?</h3>
        <p class="text-slate-600 mt-2">
          Absolutely. You can change your plan at any time.
        </p>
      </div>

    </div>
  </div>
</section>

<!-- ================= CTA ================= -->
<section class="py-24 bg-gradient-to-r from-primary to-emerald-700 text-white">
  <div class="container mx-auto px-4 text-center">
    <h2 class="text-3xl md:text-4xl font-bold">
      Set a schedule for a Demo
    </h2>
    <p class="mt-4 max-w-xl mx-auto">
      See how Farmex can help you start managing your field operations more effectively today.
    </p>

    <div class="mt-8">
      <a href="/quotation?type=demo"
         class="bg-white text-primary px-10 py-4 rounded-xl font-semibold shadow-lg">
        Schedule Demo
      </a>
    </div>
  </div>
</section>

</main>

<!-- ================= FOOTER ================= -->
<footer class="border-t py-8">
  <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-500">
    <span>© {{ date('Y') }} FarmEx</span>
    <div class="flex gap-4">
      <a href="#" class="hover:text-slate-800">Terms</a>
      <a href="#" class="hover:text-slate-800">Privacy</a>
    </div>
  </div>
</footer>

  <script>
    // Smooth scrolling with offset for sticky header
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          const headerOffset = 80; // Height of sticky header
          const elementPosition = target.getBoundingClientRect().top;
          const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

          window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
          });

          // Add a subtle highlight effect to the target section
          target.style.transition = 'background-color 0.3s ease';
          target.style.backgroundColor = 'rgba(40, 126, 54, 0.05)';
          setTimeout(() => {
            target.style.backgroundColor = '';
          }, 1000);
        }
      });
    });

    // Add scroll-triggered animations for sections
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observe all sections
    document.querySelectorAll('section').forEach(section => {
      observer.observe(section);
    });
  </script>

</body>
</html>
