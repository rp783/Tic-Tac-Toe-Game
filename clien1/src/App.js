import React, { useState, useEffect } from 'react';
import './App.css';
import axios, { Axios } from 'axios';
import {useNavigate} from "react-router-dom";
import { BrowserRouter as Router, Routes,Route,Link,  } from 'react-router-dom';
import Register from './Register';
import Login from './pages/Login';
import Home from './pages/home';



function App() {
  return(
    <Router>
      <nav>
        <Link to="/Login"> Login </Link>
        <Link to="/ "> Register </Link>

      </nav>
      <Routes>
        <Route path="/" element={<Register/>}/>
        <Route path="/Login" element={<Login/>}/>
        <Route path="/Home" element={<Home/>}/>

      </Routes>
    </Router>
  );
}


export default App;
