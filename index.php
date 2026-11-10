<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komis samochodowy</title>
</head>
<body>
<?php
 
$samochody = [
    ['marka' => 'Toyota', 'model' => 'Corolla', 'rok' => 2022, 'cena' => 89000, 'przebieg' => 35000, 'paliwo' => 'hybryda', 'moc' => 122],
    ['marka' => 'Volkswagen', 'model' => 'Golf', 'rok' => 2016, 'cena' => 42000, 'przebieg' => 168000, 'paliwo' => 'diesel', 'moc' => 150],
    ['marka' => 'Skoda', 'model' => 'Octavia', 'rok' => 2019, 'cena' => 63000, 'przebieg' => 112000, 'paliwo' => 'benzyna', 'moc' => 150],
    ['marka' => 'Ford', 'model' => 'Focus', 'rok' => 2012, 'cena' => 21000, 'przebieg' => 210000, 'paliwo' => 'diesel', 'moc' => 115],
    ['marka' => 'Mazda', 'model' => '6', 'rok' => 2021, 'cena' => 98000, 'przebieg' => 54000, 'paliwo' => 'benzyna', 'moc' => 165],
    ['marka' => 'Honda', 'model' => 'Civic', 'rok' => 2023, 'cena' => 112000, 'przebieg' => 18000, 'paliwo' => 'benzyna', 'moc' => 182],
    ['marka' => 'Opel', 'model' => 'Astra', 'rok' => 2009, 'cena' => 11500, 'przebieg' => 245000, 'paliwo' => 'benzyna', 'moc' => 115],
    ['marka' => 'Renault', 'model' => 'Megane', 'rok' => 2017, 'cena' => 36000, 'przebieg' => 139000, 'paliwo' => 'diesel', 'moc' => 110],
    ['marka' => 'Peugeot', 'model' => '308', 'rok' => 2020, 'cena' => 55000, 'przebieg' => 76000, 'paliwo' => 'diesel', 'moc' => 130],
    ['marka' => 'Volvo', 'model' => 'V60', 'rok' => 2014, 'cena' => 39000, 'przebieg' => 195000, 'paliwo' => 'diesel', 'moc' => 190],
    ['marka' => 'Mercedes', 'model' => 'W124', 'rok' => 1991, 'cena' => 28000, 'przebieg' => 310000, 'paliwo' => 'benzyna', 'moc' => 132],
    ['marka' => 'Tesla', 'model' => 'Model 3', 'rok' => 2023, 'cena' => 149000, 'przebieg' => 42000, 'paliwo' => 'elektryczny', 'moc' => 283],
];
 
function obliczWiek($rokProdukcji)
{
    return date('Y') - $rokProdukcji;
}
 
function wyszukajSamochody($samochody, $maksymalnaCena)
{
    $znaleziono = false;
    foreach ($samochody as $auto) {
        if ($auto['cena'] <= $maksymalnaCena) {
            echo $auto['marka'] . ' ' . $auto['model'] . ' - ' . $auto['cena'] . ' zł<br>';
            $znaleziono = true;
        }
    }
    if (!$znaleziono) {
        echo 'Nie znaleziono żadnego samochodu<br>';
    }
}
 
function najdrozszySamochod($samochody)
{
    $wynik = $samochody[0];
    foreach ($samochody as $auto) {
        if ($auto['cena'] > $wynik['cena']) {
            $wynik = $auto;
        }
    }
    return $wynik;
}
 
function najtanszySamochod($samochody)
{
    $wynik = $samochody[0];
    foreach ($samochody as $auto) {
        if ($auto['cena'] < $wynik['cena']) {
            $wynik = $auto;
        }
    }
    return $wynik;
}
 
function obliczSredniaCene($samochody)
{
    $suma = 0;
    foreach ($samochody as $auto) {
        $suma += $auto['cena'];
    }
    return $suma / count($samochody);
}
 
usort($samochody, fn($a, $b) => $a['cena'] <=> $b['cena']);
 
echo '<h1>KOMIS SAMOCHODOWY</h1>';
 
foreach ($samochody as $auto) {
    $wiek = obliczWiek($auto['rok']);
 
    if ($wiek <= 3) {
        $kategoria = 'samochód prawie nowy';
    } elseif ($wiek <= 7) {
        $kategoria = 'samochód kilkuletni';
    } elseif ($wiek <= 15) {
        $kategoria = 'samochód używany';
    } else {
        $kategoria = 'samochód zabytkowy lub starszy';
    }
 
    echo '<p>';
    echo '<b>' . $auto['marka'] . ' ' . $auto['model'] . '</b><br>';
    echo 'Rok produkcji: ' . $auto['rok'] . '<br>';
    echo 'Cena: ' . $auto['cena'] . ' zł<br>';
    echo 'Przebieg: ' . $auto['przebieg'] . ' km<br>';
    echo 'Paliwo: ' . $auto['paliwo'] . '<br>';
    echo 'Moc: ' . $auto['moc'] . ' KM<br>';
    echo 'Wiek: ' . $wiek . ' lat<br>';
    echo 'Kategoria: ' . $kategoria;
    echo '</p><hr>';
}
 
echo '<h2>Samochody do 40000 zł</h2>';
echo '<p>';
wyszukajSamochody($samochody, 40000);
echo '</p>';
 
$diesel = 0;
$po2020 = 0;
$maly = 0;
foreach ($samochody as $auto) {
    if ($auto['paliwo'] == 'diesel') {
        $diesel++;
    }
    if ($auto['rok'] > 2020) {
        $po2020++;
    }
    if ($auto['przebieg'] < 100000) {
        $maly++;
    }
}
 
$drogi = najdrozszySamochod($samochody);
$tani = najtanszySamochod($samochody);
 
echo '<h1>STATYSTYKI</h1>';
echo '<p>';
echo 'Liczba samochodów: ' . count($samochody) . '<br>';
echo 'Średnia cena: ' . round(obliczSredniaCene($samochody)) . ' zł<br>';
echo 'Najdroższy: ' . $drogi['marka'] . ' ' . $drogi['model'] . '<br>';
echo 'Najtańszy: ' . $tani['marka'] . ' ' . $tani['model'] . '<br>';
echo 'Samochody diesel: ' . $diesel . '<br>';
echo 'Samochody po 2020 roku: ' . $po2020 . '<br>';
echo 'Przebieg poniżej 100000 km: ' . $maly;
echo '</p>';
 
?>
</body>
</html>
