<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

NavBar::begin([
    'brandLabel' => 'Доска объявлений',
    'brandUrl' => Yii::$app->homeUrl,
]);
$menuItems = [
    ['label' => 'Мой профиль', 'url' => ['/profile/index']],
    ['label' => 'Добавить объявление', 'url' => ['/profile/add']],
    ['label' => 'Избранное', 'url' => ['/profile/favorite']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Вход', 'url' => ['/site/login']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link']
        )
        . Html::endForm()
        . '</li>';
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
?>