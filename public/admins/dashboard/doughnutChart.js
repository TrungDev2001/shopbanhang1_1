const data = {
    labels: [
        'Product',
        'Post',
        'Video',
        'User'
    ],
    datasets: [{
        label: 'My First Dataset',
        data: [<? php echo($count_Product) ?>, <? php echo($count_Post) ?>, <? php echo($count_Video) ?>, <? php echo($count_User) ?>],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(81, 252, 226)',
        ],
        hoverOffset: 4
    }]
};

const config1 = {
    type: 'doughnut',
    data: data,
    options: {}
};
const myChart = new Chart(
    document.getElementById('myChart1'),
    config1
);