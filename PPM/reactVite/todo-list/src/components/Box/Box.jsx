import PropTypes from 'prop-types';
// https://www.dhiwise.com/post/solution-for-children-is-missing-in-props-validation-in

export const Box = ({width = 100, height=100, color= 'blue'}) => {
    const boxStyle = {
        width: `${width}px`,
        height: `${height}px`,
        backgroundColor: color,
        display: `flex`,
        justifyContent: `center`,
        alignItems: `center`
      };
      const handleClick = (e)=>{
        alert(e.target.style.width)
      }
  return (
    <div className="box" style={boxStyle} onClick={handleClick}>BOX</div>
  )
}
Box.propTypes = {
    width: PropTypes.number,
    height:PropTypes.number,
    color:PropTypes.string
  };


