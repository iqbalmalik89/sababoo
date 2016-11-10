var WallContainer=React.createClass({
   render:function(){
    return(
    <div id="wallContainer">
     <h1>Social Network System with React JS Demo</h1>
     <WallFeed url="../../comments/getComments" postUrl="" deleteUrl=""/>
    </div>
    );
   }
});

console.log(WallContainer);
ReactDOM.render(
  <WallContainer/>,
  document.getElementById('container')
);