import React, { useRef } from "react";

const Contact = () => {
    const inputEmailRef = useRef();
    const inputNameRef = useRef();
    const inputPhoneRef = useRef();
    const inputBirthdayRef = useRef();


    const submitHandler = async (event) => {
        event.preventDefault();

        const email = inputEmailRef.current.value;
        const name = inputNameRef.current.value;
        const phone = inputPhoneRef.current.value;
        const birthday = inputBirthdayRef.current.value;

        if (email) {
            const response = await fetch(`${page.api_url}work-on/contact`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ email: email, name: name, phone: phone, birthday: birthday, })

            });

            const responseData = await response.json();

            console.log(responseData);

            if (responseData === "success") {
                alert("Dziękujemy")
            } else {
                alert("Coś poszło nie tak")
            }

            inputRef.current.value = "";

        } else {
            alert("Podaj adres e-mail")
        }
    }

    return (
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">

                            <form class="form-horizontal" method="post" onSubmit={submitHandler}>

                                <div class="form-group">
                                    <label for="name" class="cols-sm-2 control-label">Your Name</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your Name" ref={inputNameRef} />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Your Email</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email" ref={inputEmailRef}/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="cols-sm-2 control-label">Telephone</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone fa-lg" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your Telephone" ref={inputPhoneRef} />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirm" class="cols-sm-2 control-label">Birthday</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-link fa-lg" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="birthday" id="birthday" placeholder="Enter your Birthday" ref={inputBirthdayRef} />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    )
}

export default Contact;