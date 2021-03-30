const formatNumber = (number, style, locale) => {
    number = new Intl.NumberFormat(locale, style).format(number);
    return number;
}