<script>
export default {
    props:['answer'],

    data()
    {
        return{
            editing:false,
            body:this.answer.body,
            bodyHtml:this.answer.body_html,
            id:this.answer.id,
            questionId:this.answer.question_id,
            beforeEditCache:null,
            
        }
    },
    methods:{
         edit () {
            this.beforeEditCache = this.body;
            this.editing = true;
        },
        cancel () {
            this.body = this.beforeEditCache;
            this.editing = false;
        },
        update(){ 
             
            axios.patch(this.endpoint, {
                body: this.body
            })
            .then(res => {
                this.bodyHtml=res.data.body_html;
                this.editing=false;
                alert(res.data.message);
            })
            .catch(err=>{
                alert(err.response.data.message);
                this.editing=false;
            });
        },

        destroy()
        {
            if(confirm('Are You Sure You Want To Delete This Answer?'))
            {
                axios.delete(this.endpoint)
                .then(res=>{
                    $(this.$el).fadeOut(500,()=>{
                        alert(res.data.message);
                    })
                })
                .catch(err=>{

                });
            }
        }
    },
    computed:{
        isInvalid(){
            return this.body.length < 10;
        },
        endpoint(){
            return `/questions/${this.questionId}/answers/${this.id}`;
        }
    }
}
</script>