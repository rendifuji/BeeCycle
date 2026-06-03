<?php

function normalizePriceInput($value) {
    return preg_replace('/\D/', '', trim((string) $value));
}

function formatPriceDisplay($value) {
    $digits = normalizePriceInput($value);

    if ($digits === '') {
        return 'Rp 0';
    }

    return 'Rp ' . number_format((int) $digits, 0, ',', '.');
}

function isValidPriceInput($value) {
    $digits = normalizePriceInput($value);

    return $digits !== '' && (int) $digits > 0;
}
