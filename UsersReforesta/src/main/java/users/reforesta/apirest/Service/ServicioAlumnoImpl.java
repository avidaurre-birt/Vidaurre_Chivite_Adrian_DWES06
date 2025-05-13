package users.reforesta.apirest.Service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import users.reforesta.apirest.Entity.User;
import users.reforesta.apirest.Dao.UserDAO;

@Service
public class ServicioAlumnoImpl implements ServicioUser {
	
	@Autowired
	private UserDAO userDAO;

	@Override
	public List<User> findAll() {
		List<User> listUsers = userDAO.findAll();
		return listUsers;
	}

	@Override
	public User findById(int id) {
		User user = userDAO.findById(id);
		return user;
	}

	@Override
	public void save(User user) {
		userDAO.save(user);
	}

	@Override
	public void deleteById(int id) {
		userDAO.deleteById(id);

	}

}
