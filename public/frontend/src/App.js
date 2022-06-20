import logo from './logo.svg';
import './App.css';
import './assets/css/style.css';
import './assets/css/responsive.css';
import {BrowserRouter as Router,Route,Routes} from 'react-router-dom';
import Home from './screens/Home';
import About from './screens/About';
import Giveaway from './screens/Giveaway';
import Header from "./components/Header"
import Footer from './components/Footer';
import Faq from './components/Faq';
// import Giveaway from "./screens/Giveaway"

function App() {
  return (
    <Router>


    <Routes>
 
      
      <Route path="/" element={<Home header={<Header/>} footer={<Footer/>}/>} />
      <Route path="/about" element={<About header={<Header/>} footer={<Footer/>}/>} />
      <Route path="/giveaway" element={<Giveaway header={<Header/>} footer={<Footer/>}/>} />
      <Route path="/faq" element={<Faq header={<Header/>} footer={<Footer/>}/>} />

  
    </Routes>
  </Router>
  );
}

export default App;
