<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="theme-color" content="#04203D">
<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="192x192" href="/images/icon-192.png">
<title>{{ __('auth.otp_title') }} | Solberg Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">
<style>
:root{
  --navy:#04203D;--nm:#12446E;--nl:#4A5D73;
  --gold:#B8883E;--gd:#96702F;--gp:#F3E8D6;
}
html,body{height:100%;margin:0;padding:0}
body{font-family:'Montserrat',sans-serif;background:#fff;min-height:100vh;display:flex;flex-direction:column}

.auth-left{
  background:linear-gradient(160deg,#04203D 0%,#04203D 45%,#0A3559 100%);
  min-height:100vh; padding:2.5rem 3rem;
  display:flex;flex-direction:column;justify-content:space-between;
  position:relative;overflow:hidden;
}
.auth-left::before{
  content:'';position:absolute;inset:0;pointer-events:none;
  background-image:
    linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
  background-size:40px 40px;
}
.auth-left::after{
  content:'';position:absolute;top:-100px;right:-100px;
  width:380px;height:380px;border-radius:50%;
  background:radial-gradient(circle,rgba(184,136,62,.08) 0%,transparent 70%);
  pointer-events:none;
}
.auth-left__logo img{height:40px;position:relative;z-index:1}
.auth-left__body{position:relative;z-index:1}

.staff-badge{
  display:inline-flex;align-items:center;gap:.625rem;
  background:rgba(184,136,62,.08);border:1px solid rgba(184,136,62,.2);
  border-radius:12px;padding:.625rem 1rem;margin-bottom:1.75rem;
}
.staff-badge__ico{
  width:32px;height:32px;border-radius:8px;
  background:rgba(184,136,62,.12);display:flex;align-items:center;justify-content:center;
}
.staff-badge__ico i{color:var(--gold);font-size:.75rem}
.staff-badge__text{line-height:1.3}
.staff-badge__label{font-size:.72rem;font-weight:700;color:var(--gold);letter-spacing:.05em;text-transform:uppercase}
.staff-badge__sub{font-size:.68rem;color:rgba(255,255,255,.35)}

.auth-left__title{
  font-family:'Montserrat',serif;font-size:2.25rem;font-weight:800;
  color:#fff;line-height:1.2;margin-bottom:.875rem;
}
.auth-left__title span{color:var(--gold)}
.auth-left__sub{font-size:.875rem;color:rgba(255,255,255,.4);line-height:1.8;margin-bottom:2rem;max-width:340px}

.auth-left__copy{font-size:.7rem;color:rgba(255,255,255,.2);position:relative;z-index:1}

.auth-right{background:#fff;display:flex;flex-direction:column;min-height:100vh}
.auth-topbar{
  display:flex;align-items:center;justify-content:space-between;
  padding:1.25rem 2rem;border-bottom:1px solid #f0f2f5;flex-shrink:0;
}
.auth-topbar__back{
  display:inline-flex;align-items:center;gap:.45rem;
  font-size:.8rem;color:#6b7280;text-decoration:none;font-weight:500;transition:color .18s;
}
.auth-topbar__back:hover{color:var(--navy)}
.auth-topbar__logo img{height:34px}

.auth-form-wrap{flex:1;display:flex;align-items:center;justify-content:center;padding:2rem}
.auth-form-inner{width:100%;max-width:400px;text-align:center}

.otp-icon{
  width:64px;height:64px;border-radius:18px;
  background:linear-gradient(135deg,rgba(184,136,62,.16),rgba(150,112,47,.16));
  border:1.5px solid rgba(184,136,62,.3);
  display:flex;align-items:center;justify-content:center;
  margin:0 auto 1.25rem;
}
.otp-icon i{font-size:1.75rem;color:var(--gd)}

.form-title{
  font-family:'Montserrat',serif;font-size:1.75rem;font-weight:800;
  color:var(--navy);line-height:1.15;margin-bottom:.5rem;
}
.form-sub{font-size:.82rem;color:#6b7280;margin-bottom:1.75rem;line-height:1.6}
.form-sub strong{color:var(--navy)}

.auth-error{
  display:flex;align-items:center;gap:.5rem;text-align:left;
  background:#fef2f2;border:1px solid #fecaca;border-left:3px solid #ef4444;
  border-radius:9px;padding:.7rem .9rem;font-size:.8rem;color:#991b1b;
  margin-bottom:1rem;
}

.odigits{display:flex;gap:.5rem;justify-content:center;margin-bottom:1.25rem}
.odigit{
  width:52px;height:56px;border-radius:12px;
  background:#f8f9fb;border:1.5px solid #e5e7eb;
  text-align:center;font-size:1.4rem;font-weight:800;color:var(--navy);
  font-family:'Montserrat',sans-serif;
  outline:none;transition:border-color .2s,box-shadow .2s;
}
.odigit:focus{border-color:var(--navy);box-shadow:0 0 0 3px rgba(4,32,61,.08)}
.odigit.is-err{border-color:#ef4444;box-shadow:0 0 0 3px rgba(239,68,68,.08)}

.btn-auth{
  width:100%;padding:.8rem;border:none;border-radius:10px;
  font-size:.9rem;font-weight:700;font-family:'Montserrat',sans-serif;cursor:pointer;
  display:flex;align-items:center;justify-content:center;gap:.5rem;
  background:var(--navy);color:#fff;
  transition:background .2s,transform .12s;letter-spacing:.01em;margin-bottom:.75rem;
}
.btn-auth:hover{background:#04203D}
.btn-auth:active{transform:scale(.98)}
.btn-auth:disabled{opacity:.5;cursor:not-allowed}

.resend-row{font-size:.79rem;color:#6b7280;margin-top:.5rem}
.resend-btn{background:none;border:none;cursor:pointer;padding:0;font-size:.79rem;font-weight:700;color:var(--gd)}
.resend-btn:disabled{opacity:.4;cursor:not-allowed}
.resend-msg{display:block;font-size:.74rem;font-weight:600;margin-top:.35rem}
.resend-msg.ok{color:#059669}.resend-msg.fail{color:#dc2626}

.auth-footer{padding:.875rem 2rem 1.25rem;text-align:center;font-size:.72rem;color:#9ca3af;flex-shrink:0}

@media (max-width:991.98px){
  .auth-left{display:none!important}
  .auth-topbar{padding:1rem 1.25rem}
  .auth-form-wrap{padding:1.5rem 1.25rem}
}
</style>
</head>
<body>
<div class="container-fluid p-0" style="min-height:100vh">
<div class="row g-0" style="min-height:100vh">

  <div class="col-lg-5 d-none d-lg-flex">
    <div class="auth-left w-100">
      <div class="auth-left__logo">
        <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo-white-icon.png') }}" alt="Solberg Grupo"></a>
      </div>
      <div class="auth-left__body">
        <div class="staff-badge">
          <div class="staff-badge__ico"><i class="fas fa-shield-halved"></i></div>
          <div class="staff-badge__text">
            <div class="staff-badge__label">{{ __('auth.staff_restricted') }}</div>
            <div class="staff-badge__sub">credixa.eu &mdash; secure access</div>
          </div>
        </div>
        <h2 class="auth-left__title">{{ __('auth.otp_heading') }}</h2>
        <p class="auth-left__sub">{{ __('auth.otp_subtitle') }}</p>
      </div>
      <div class="auth-left__copy">&copy; {{ date('Y') }} Solberg Grupo Invest</div>
    </div>
  </div>

  <div class="col-12 col-lg-7">
    <div class="auth-right">

      <div class="auth-topbar">
        <a href="{{ $backUrl ?? route('staff.login') }}" class="auth-topbar__back">
          <i class="fas fa-arrow-left"></i> {{ __('auth.otp_back') }}
        </a>
        <a href="{{ url('/') }}" class="auth-topbar__logo d-lg-none">
          <img src="{{ asset('assets/images/logo-transparent-icon.png') }}" alt="Solberg Grupo">
        </a>
      </div>

      <div class="auth-form-wrap">
        <div class="auth-form-inner" x-data="staffOtpApp()">

          <div class="otp-icon"><i class="fas fa-shield-halved"></i></div>
          <h1 class="form-title">{{ __('auth.otp_heading') }}</h1>
          <p class="form-sub">{{ __('auth.otp_subtitle') }}<br><strong>{{ $masked }}</strong></p>

          <div class="auth-error" x-show="errorMsg" x-transition style="display:none">
            <i class="fas fa-exclamation-circle flex-shrink-0"></i>
            <span x-text="errorMsg"></span>
          </div>

          <form id="otp-form" @submit.prevent="doSubmit()">
            <div class="odigits">
              <template x-for="(d, i) in digits" :key="i">
                <input type="text" inputmode="numeric" maxlength="1" class="odigit"
                       :class="{ 'is-err': hasErr }"
                       x-model="digits[i]"
                       @input="onInput($event, i)"
                       @keydown.backspace="onBackspace($event, i)"
                       @paste="onPaste($event)">
              </template>
            </div>

            <button type="submit" class="btn-auth" :disabled="digits.join('').length < 6 || submitting">
              <template x-if="!submitting">
                <span><i class="fas fa-check me-1"></i>{{ __('auth.otp_verify_btn') }}</span>
              </template>
              <template x-if="submitting">
                <span><i class="fas fa-circle-notch fa-spin"></i></span>
              </template>
            </button>
          </form>

          <div class="resend-row">
            <span x-show="timeLeft > 0">{{ __('auth.otp_resend_in') }} <strong x-text="fmtTime()"></strong></span>
            <template x-if="timeLeft <= 0 && !resending">
              <button type="button" class="resend-btn" @click="resend()">{{ __('auth.otp_resend') }}</button>
            </template>
            <template x-if="resending">
              <i class="fas fa-circle-notch fa-spin"></i>
            </template>
            <span class="resend-msg" :class="resendOk ? 'ok' : 'fail'" x-show="resendMsg" x-text="resendMsg"></span>
          </div>

        </div>
      </div>

      <div class="auth-footer">&copy; {{ date('Y') }} Solberg Grupo Invest</div>
    </div>
  </div>

</div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
function staffOtpApp() {
  return {
    digits: ['','','','','',''],
    timeLeft: 120,
    timer: null,
    submitting: false,
    resending: false,
    resendMsg: '',
    resendOk: true,
    errorMsg: '',
    hasErr: false,

    init() {
      this.startTimer();
      this.$nextTick(() => { var f = this.$el.querySelector('.odigit'); if (f) f.focus(); });
    },

    startTimer() {
      clearInterval(this.timer);
      this.timeLeft = 120;
      this.timer = setInterval(() => { if (this.timeLeft > 0) this.timeLeft--; }, 1000);
    },

    fmtTime() {
      var m = Math.floor(this.timeLeft / 60), s = this.timeLeft % 60;
      return (m < 10 ? '0'+m : m) + ':' + (s < 10 ? '0'+s : s);
    },

    onInput(e, i) {
      var v = (e.target.value || '').replace(/\D/g, '').slice(0, 1);
      this.digits[i] = v;
      if (v && i < 5) {
        var next = this.$el.querySelectorAll('.odigit')[i + 1];
        if (next) next.focus();
      }
      if (this.digits.join('').length === 6) this.$nextTick(() => this.doSubmit());
    },

    onBackspace(e, i) {
      if (this.digits[i] === '' && i > 0) {
        var prev = this.$el.querySelectorAll('.odigit')[i - 1];
        if (prev) { prev.focus(); this.digits[i - 1] = ''; }
      }
    },

    onPaste(e) {
      e.preventDefault();
      var val = (e.clipboardData.getData('text') || '').replace(/\D/g, '').slice(0, 6);
      for (var i = 0; i < 6; i++) this.digits[i] = val[i] || '';
      if (val.length === 6) this.$nextTick(() => this.doSubmit());
    },

    async doSubmit() {
      if (this.digits.join('').length < 6 || this.submitting) return;
      this.submitting = true;
      this.errorMsg = '';
      try {
        var resp = await fetch('{{ route("otp.verify") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: JSON.stringify({ code: this.digits.join('') }),
        });
        var data = await resp.json();

        if (data.status === 'success' || data.status === 'blocked' || data.status === 'redirect') {
          window.location.href = data.url;
          return;
        }
        this.hasErr = true;
        this.errorMsg = data.message || '{{ __("auth.otp_invalid", ["remaining" => 1]) }}';
        this.submitting = false;
        setTimeout(() => { this.hasErr = false; this.digits = ['','','','','','']; this.$el.querySelector('.odigit').focus(); }, 500);
      } catch (err) {
        this.errorMsg = '{{ __("auth.otp_send_failed") }}';
        this.submitting = false;
      }
    },

    async resend() {
      if (this.resending || this.timeLeft > 0) return;
      this.resending = true;
      this.resendMsg = '';
      try {
        var resp = await fetch('{{ route("otp.resend") }}', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        });
        var data = await resp.json();
        if (resp.ok) {
          this.resendOk = true;
          this.resendMsg = data.message || '{{ __("auth.otp_resend_success") }}';
          this.digits = ['','','','','',''];
          this.errorMsg = '';
          this.startTimer();
        } else {
          this.resendOk = false;
          this.resendMsg = data.error || '{{ __("auth.otp_send_failed") }}';
        }
      } catch (err) {
        this.resendOk = false;
        this.resendMsg = '{{ __("auth.otp_send_failed") }}';
      }
      this.resending = false;
      var self = this;
      setTimeout(function () { self.resendMsg = ''; }, 4000);
    },
  };
}
</script>
</body>
</html>
