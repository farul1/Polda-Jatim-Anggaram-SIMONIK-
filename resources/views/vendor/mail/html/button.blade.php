@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<style>
    .button {
        background-color: #362F2E; /* Warna Coklat Polisi */
        border-bottom: 8px solid #362F2E;
        border-left: 18px solid #362F2E;
        border-right: 18px solid #362F2E;
        border-top: 8px solid #362F2E;
        color: #ffffff;
        display: inline-block;
        text-decoration: none;
        border-radius: 3px;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
        -webkit-text-size-adjust: none;
        box-sizing: border-box;
    }

    .button--green {
        background-color: #22bc66;
        border-bottom: 8px solid #22bc66;
        border-left: 18px solid #22bc66;
        border-right: 18px solid #22bc66;
        border-top: 8px solid #22bc66;
    }
    /* ... sisa style ... */
</style>
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a href="{{ $url }}" class="button button-{{ $color }}" target="_blank" rel="noopener">{{ $slot }}</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
