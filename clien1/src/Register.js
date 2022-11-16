import React, { useState } from 'react';
//import axios, { Axios } from 'axios';
import {useNavigate} from 'react-router-dom';
import send from './send';


function Register() {
    let navigate = useNavigate();

    //const [ID, setID] = useState("");
    const [UserName, setUserName] = useState("");
    const [Password, setPassword] = useState("");
    const [FirstName, setFirstName] = useState("");
    const [LastName, setLastName] = useState("");
    const [Email, setEmail] = useState("");
    const msg = {UserName,Password,FirstName,LastName,Email};
    const exchange = 'Test';
    const queue = 'Test2'
    send.sendmsg(exchange,queue,msg);

    const register = () => {
         ("/", {
          //ID:ID,
          UserName: UserName,
          Password: Password,
          FirstName: FirstName,
          LastName: LastName,
          Email: Email,
           }).then (() =>{
           });
      };

    return(
    <div className='App'>
    <h1>Registration</h1>

    <div className="form">
        <label>UserName</label>-
   <input type="text" name="UserName" onChange={(e)=>{
    setUserName(e.target.value)
   }} 
   />
   <label>Password</label>
   <input type="password" name="Password" onChange={(e)=>{
    setPassword(e.target.value)
   }} 
   />
   <label>FirstName</label>
   <input type="text" name="FirstName" onChange={(e)=>{
    setFirstName(e.target.value)
   }} 
   />
   <label>LastName</label>
   <input type="text" name="LastName" onChange={(e)=>{
    setLastName(e.target.value)
   }} 
   />
   
   
   
   <label>Email:</label>
   <input type="text" name="Email"  onChange={(e)=>{
    setEmail(e.target.value)
   }} />

   <button onClick={register}>Submit</button>
   <button onClick={() => {navigate("/Login")}}> Sign in </button>

   </div>
   </div>
    
    );
}

export default Register;