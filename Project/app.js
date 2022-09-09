var needDo = 0;
var completeDo = 0;
Data = {
    type: 'pie',
    data: {
        labels: ['Невыполненные задачи', 'Выполненные задачи'],
        datasets: [{
            data: [needDo, completeDo],
            backgroundColor: ['#e91e63', '#00e676']
        }]
    },
    options: {
        title: {
            display: true,
            text: 'График соотношения вашей продуктивности',
            position: 'top',
            fontSize: 24,
            fontColor: 'rgb(0, 0, 0)',
            padding: 20,
            fontFamily: 'Ubuntu'
        },
        legend: {
            labels: {
                fontSize: 18,
                fontColor: 'rgb(0, 0, 0)',
                fontFamily: 'Ubuntu'
            }
        }
    }
}
var ctx = document.getElementById('results-graph').getContext('2d');
var myChart = new Chart(ctx, Data);

function chartUpdate() {
    myChart.destroy();
    ctx = document.getElementById("results-graph").getContext("2d");
    Data.data.datasets[0].data[0] = needDo;
    Data.data.datasets[0].data[1] = completeDo;
    myChart = new Chart(ctx, Data);
}

Vue.createApp({
    data() {
        return {
            valueInput: '',
            needDoList: [],
            completeList: []
        };
    },
    methods: {
        handleInput(event) {
            this.valueInput = event.target.value;
        },
        addTask() {
            if (this.valueInput === '') { return };
            this.needDoList.push({
                title: this.valueInput,
                id: Math.random()
            });
            this.valueInput = '';
            needDo = this.needDoList.length;
            completeDo = this.completeList.length;
            chartUpdate();
        },
        doCheck(index, type) {
            if (type === 'need') {
                const completeMask = this.needDoList.splice(index, 1);
                this.completeList.push(...completeMask);
            } else {
                const noCompleteMask = this.completeList.splice(index, 1);
                this.needDoList.push(...noCompleteMask);
            }
            needDo = this.needDoList.length;
            completeDo = this.completeList.length;
            chartUpdate();
        },
        removeMask(index, type) {
            const toDoList = type === 'need' ? this.needDoList : this.completeList;
            toDoList.splice(index, 1);
            needDo = this.needDoList.length;
            completeDo = this.completeList.length;
            chartUpdate();
        }
    }
}).mount('#app');