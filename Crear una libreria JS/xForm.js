function _(classname) {
    if (classname) {
        if (window === this) {
            return new _(classname);
        }
        if (!document.getElementsByClassName) {
            document.getElementsByClassName = function() {
                var a = [];
                var re = new RegExp('(^| )' + classname + '( |$)');
                var els = document.body.getElementsByTagName("*");
                for (var i = 0, j = els.length; i < j; i++)
                if (re.test(els[i].className)) a.push(els[i]);
                return a;
            }
        }
        this.el = document.getElementsByClassName(classname);
        return this;
    } else {
        return about;
    }
}


/* Functions */
_.prototype = {
    isrequired: function() {
        for (var i = this.el.length - 1; i >= 0; i--) {
            if (this.el[i].value === "" || this.el[i].value === "undefined") {
                alert("el campo es obligatorio");
            }
        };
        return this;
    },
    isnumber: function() {
        var regex_number = /^\d+$/;
        for (var i = this.el.length - 1; i >= 0; i--) {
            if ((this.el[i].value).match(regex_number)) {
                alert("si es numerico");
            } else {
                alert("el campo debe ser numerico");
            }
        };
        return this;
    },
    isemail: function() {
        var regex_email = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;

        for (var i = this.el.length - 1; i >= 0; i--) {
            if (regex_email.test(this.el[i].value)) {
                alert("si es correo valido");
            } else {
                alert("no es correo valido");
            }
        };
        return this;
    },
    issecurepassword: function(){
        var regex_pass = /^[A-Za-z\d]{6,8}$/; //Mayus + Minus + digits

         for (var i = this.el.length - 1; i >= 0; i--) {
            if ((this.el[i].value).match(regex_pass)) {
                alert("Password seguro");
            } else {
                alert("PAssword no seguro");
            }
        };
    },

};
