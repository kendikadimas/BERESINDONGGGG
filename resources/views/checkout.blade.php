<!DOCTYPE html>
<html>
<head>
    <title>Proses Pembayaran</title>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <style>body { font-family: sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }</style>
</head>
<body>
    <p>Mempersiapkan halaman pembayaran...</p>
    <script type="text/javascript">
      window.snap.pay('{{ $snapToken }}', {
        onClose: function(){ window.close(); }
      });
    </script>
</body>
</html>