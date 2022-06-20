import { Navbar, Container, Nav, NavDropdown } from "react-bootstrap";
import Logo from "../assets/images/logo.png"
import {useState, useEffect} from "react"
import { Link } from "react-router-dom";
import { useWeb3React } from "@web3-react/core";
import {injectedConnector} from "../utils/connectors"
import { connectWallet } from "../utils/connectWallet";
import Jarlathart from "../assets/images/Jarlathart.png";
import Pdf from '../assets/nft_5.pdf';




function Header(){

const [navbar, setNavbar] = useState(false);
const [loaded, setLoaded] = useState(false)


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

useEffect(() => {
  injectedConnector
    .isAuthorized()
    .then((isAuthorized) => {
      setLoaded(true)
      if (isAuthorized && !networkActive && !networkError) {
        activateNetwork(injectedConnector)
      }
    })
    .catch(() => {
      setLoaded(true)
    })
}, [activateNetwork, networkActive, networkError])

useEffect(() => {
    window.addEventListener("scroll", () => {
      if (window.pageYOffset > 80) {
        setNavbar(true);
      } else {
        setNavbar(false);
      }
    });
  }, []);

    return(

        <>
        
        <Navbar collapseOnSelect expand="lg" className={ navbar ? "custom-nav active" : "custom-nav"}>
            <Container className="justify-content-between">

            <Link to={"/"} className="logo">
                <img src={Jarlathart}/>
            </Link>

            <Navbar.Toggle aria-controls="responsive-navbar-nav" />
            <Navbar.Collapse id="responsive-navbar-nav"  className="justify-content-end">
               
         
                <Nav >
                <Link to={"/"} href="#">Home</Link>
                <Link to={"/about"} href="#">About</Link>
                {/* <Link to={"#"} href="#">Collection</Link> */}
                <Link style={{paddingRight:"10px"}} to={"/faq"} href="#">FAQ</Link>
                <Link style={{paddingRight:"10px"}} to={"#"} href="#" onClick={() => window.open(Pdf)}>White Paper</Link>
                {/* <Link to={"/giveaway"} href="#">Give Away</Link> */}

                { active
                ?(
                  <button  className="custom-btn primary-btn">Connected</button>
                ): <button onClick={(e) => {
                  connectWallet(activate, "Error");
                  e.preventDefault()
                }} className="custom-btn primary-btn">Connect</button>
                }

                {/* <button  className="custom-btn primary-btn">Connect</button> */}
                </Nav>
            </Navbar.Collapse>
            </Container>
        </Navbar>

        </>

    )



}

export default Header;