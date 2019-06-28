import Vue from 'vue';

const VEvent = class {
    constructor() {
        this.vue = new Vue();
    }
    
    listen(event, callback) {
        if (Array.isArray(event)) {
            event.forEach(
                eventName => this.vue.$on(eventName, (callback))
            );
        } else {
            this.vue.$on(event, (callback));
        }
        
        return this;
    }
    
    fire(event, data = null) {
        this.vue.$emit(event, data);
        
        return this;
    }
    
    stop(event, callback) {
        if (Array.isArray(event)) {
            event.forEach(
                eventName => this.vue.$off(eventName, (callback))
            );
        } else {
            this.vue.$off(event, (callback));
        }
        
        return this;
    }
};

export default VEvent;
