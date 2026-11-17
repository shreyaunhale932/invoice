with open(r'resources/views/invoice_front/includes/footer.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Find the FIRST closing of the DOMContentLoaded block = end of "first script tag" block
# The first <script> in the jQuery section starts with closeRegisterPopup or closeForgotPopup
# We need to find the second </script> occurrence which closes the first big inline script block

# Strategy: find the Bootstrap CDN script tag, then the next <script> open,
# then the FIRST </script> that closes it = end of "modal animation/open" block

bootstrap_cdn = '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>'
bs_idx = content.find(bootstrap_cdn)
if bs_idx == -1:
    # Try with possible whitespace variation
    bs_idx = content.find('bootstrap.bundle.min.js')
    print(f'Bootstrap CDN at: {bs_idx}')
else:
    print(f'Bootstrap CDN at: {bs_idx}')

# After bootstrap CDN, find the next <script> open tag
script_open_after_bs = content.find('<script>', bs_idx)
print(f'First <script> after bootstrap CDN at: {script_open_after_bs}')

# That script block ends at the first </script> after it
script_close_1 = content.find('</script>', script_open_after_bs)
print(f'Close of that script block at: {script_close_1}')
# Base = everything up to and including that </script>
cut_point = script_close_1 + len('</script>')
base_content = content[:cut_point]
print(f'Base content length: {len(base_content)}')

# verify we cut at the right place
print('Last 200 chars of base:')
print(repr(base_content[-200:]))

