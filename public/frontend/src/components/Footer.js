import { Col, Container, Row } from "react-bootstrap";
import Logo from "../assets/images/logo.png"
import {useState, useEffect} from "react"
import { Link } from "react-router-dom";

function Footer(){

    const [showButton, setShowButton] = useState(false);

    useEffect(() => {
      window.addEventListener("scroll", () => {
        if (window.pageYOffset > 500) {
          setShowButton(true);
        } else {
          setShowButton(false);
        }
      });
    }, []);
  
    // This function will scroll the window to the top 
    const scrollToTop = () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth' // for smoothly scrolling
      });
    };

    return(

        <>
        


        <footer>

        {showButton && (
        <div className="to-top">
            <button onClick={scrollToTop}><i class="fa-solid fa-up-long"></i></button>
        </div>
        )}

            <Container>

               <Row>

                   <Col lg={4} className="first-footer">

                    <div  className="footer-logo">
                       <Link to={"/"}> <img src={Logo}/></Link>
                    </div>

                    <p>2022, All rights reserved by Jarlath</p>


                   </Col>

                   <Col lg={4}>

                   </Col>

                   <Col lg={4} className="second-footer">

                    
                    <h4>Follow Us</h4>

                    <ul class="social">
                        <li>
                            <a href="#" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                        </li>
                        
                        <li>
                            <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        </li>

                        <li>
                            <a href="#" target="_blank"><i class="fa-brands fa-discord"></i></a>
                        </li>

                        </ul>

                   </Col>
                   
               </Row>

            </Container>
        </footer>

        </>

    )

}

export default Footer;