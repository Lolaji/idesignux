<template>
    <div class="idx-company-value pt-4">
        
        <div class="col-lg-12 col-md-10 col-md-7">
            <ul 
                class="value wow slideInDown"
                data-wow-duration="2s">
                <li 
                    v-for="(value, key) in company_value"
                    :key="key"
                    :class="{active: active(key)}"
                    @click="navigate('', key)">
                        {{value.letter}}
                </li>
            </ul>
        </div>

        <div class="value-description">
            <div class="row justify-content-center">
                <div class="col-md-2 text-center">
                    <button 
                        type="button" 
                        class="btn btn-link navigator wow slideInUp"
                        data-wow-duration="2s"
                        :disabled="disabled()"
                        @click="navigate('backward')">
                        <i class="fa fa-angle-left"></i>
                    </button>
                </div>
                <div class="col-md-6">
                    <div 
                        class="value-description-text shadow rounded text-center wow slideInUp"
                        data-wow-duration="2s"
                        v-html="highlightWord (company_value[acitveIndex].description)"></div>
                </div>
                <div class="col-md-2 text-center">
                    <button 
                        type="button" 
                        class="btn btn-link navigator wow slideInUp"
                        data-wow-duration="2s"
                        :disabled="disabled('right')"
                        @click="navigate('forward')">
                        <i class="fa fa-angle-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            acitveIndex: 0,
            company_value: [
                {
                    letter: "I",
                    word: "Incredible",
                    description: "We use our infinite creativity to implement the best solution for our client's need and deliver an incredible product that leaves them gasp in astonishment"
                },
                {
                    letter: "M",
                    word: "Measure success",
                    description: "we put ourselves in our client's shoes and measure success by how much we amazed them"
                },
                {
                    letter: "P",
                    word: "Possible",
                    description: "we think positively to make the impossible in our client's idea/vision possible."
                },
                {
                    letter: "A",
                    word: "Achieve",
                    description: "We stay positive and motivated to achieve our aim no matter how hard it is"
                },
                {
                    letter: "C",
                    word: "Committed",
                    description: "We are always committed to excellence"
                },
                {
                    letter: "T",
                    word: "Tight-knit",
                    description: "We work as a tight-knit group to create the uniqueness in our client's business / organization and make their business standout"
                }
            ]
        }
    },
    methods: {
        navigate (direction='', index=0) {
            let valueCount = this.company_value.length-1;
            switch(direction.toLowerCase()) {
                case 'forward':
                    if (this.acitveIndex < valueCount)
                        this.acitveIndex+=1;
                    break;

                case 'backward':
                    if (this.acitveIndex > 0)
                        this.acitveIndex-=1;
                    break;
                default:
                    this.acitveIndex = index;
                    break;
            }
        },
        active(index) {
            return this.acitveIndex == index;
        },
        disabled(btn_position="left"){
            if (btn_position == 'right'){
                return this.acitveIndex == (this.company_value.length-1)
            }
            return this.acitveIndex == 0;
        },
        highlightWord(description){
            let word = this.company_value[this.acitveIndex].word.toLowerCase(),
                regx = new RegExp(` ${word}( |.|)`);

            return _.replace(description, regx, ` <span class="word">${word}</span> `);
        }
    }
}
</script>