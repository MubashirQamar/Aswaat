import { Col, Container, Row, Accordion } from "react-bootstrap";
import MainSection from "../components/Mainsection"
import Collection from "../components/Collection"
import Faq from "../components/Faq";
import Team from "../components/Team";
import portfolio from "../assets/images/nftimg.jpg"
import Roadmap from "../components/Roadmap";
import banner from "../assets/images/banner.png"
import { connectWallet } from "../utils/connectWallet";
import { useWeb3React } from "@web3-react/core";



function Home(props){
    const {
        connector,
        library,
        account,
        chainId,
        activate,
        deactivate,
        active,
        errorWeb3Modal,
        active: networkActive, error: networkError, activate: activateNetwork
      } = useWeb3React();
    return(

        <>
        
            {props.header}
           
                <div>
                <img src={banner} className="banner" />
                </div>


                <div className="main">

                {/* <Collection/> */}

                    <section className="about-section">

                        <Container>
                        <div className="section-title" style={{marginBottom:"5%"}}>
                            <h2>Crypto Pugs</h2>
                        </div>
                            <Row>

                                <Col lg={4}>

                                <div>
                                    
                                    <img src={portfolio} className="animate"/>

                                </div>

                                </Col>

                                <Col lg={8}>
                                <div className="right-section">
                                    <div className="heading">
                                        {/* <h3>About Us</h3> */}
                                        <h2>NFT COLLECTION</h2>
                                        
                                    </div>
                                   <button className="custom-btn primary-btn"onClick={(e) => {
                  connectWallet(activate, "Error");
                  e.preventDefault()
                }} style={{borderRadius:"20px"}}>BUY NFT</button>

                                </div>

                                {/* <p>Sed ut perspiciatis unde omnis iste natus enim ad minim veniam, quis nostrud exercit
                                        <br/><br/>
                                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat 
                                    nulla pariatur. Excepteur sint occae cat cupidatat non proident, sunt in culpa qui officia 
                                    dese runt mollit anim id est laborum velit esse cillum dolore eu fugiat nulla pariatu epteur sint occaecat</p> */}
                                </Col>
                            </Row>
                        </Container>

                    </section>

                    

                    <Faq/>

                    <Team/>

                    <Roadmap/>

                </div>

            {props.footer}


        </>

    )
}

export default Home;