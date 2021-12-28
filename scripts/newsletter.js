import React, { useRef } from "react";

const Newsletter = () => {
    const inputRef = useRef();

    const submitHandler = async (event) => {
        event.preventDefault();

        const email = inputRef.current.value;

        if (email) {
            const response = await fetch(`${page.api_url}workon/newsletter`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({email: email})
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
        <div className="container" data-aos="fade-up">
            <div className="row">
                <div className="col-lg-4">
                    <p className="newsletter--description">{page.newsletter_data.description}</p>
                </div>
                <div className="col-lg-8 col-xl-7 col-xxl-6">
                    <h2 className="newsletter--heading">{page.newsletter_data.heading}</h2>
                    <form onSubmit={submitHandler}>
                        <div className="input-group">

                            <input type="text" className="form-control form-control-lg" placeholder="Podaj adres e-mail" ref={inputRef} />
                            <button className="btn btn-primary input-group-text"><i className="fas fa-arrow-right mx-3"></i></button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    )
}

export default Newsletter;