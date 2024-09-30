
import PropTypes from 'prop-types';

export const Rectangulo = props => {
  return (
    <div className="rectangulo">
        {props.children}
    </div>
  )
}

Rectangulo.propTypes = {
    children: PropTypes.node
  };