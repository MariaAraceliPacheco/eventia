package com.eventia.demo.services;

import java.util.List;

import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.server.ResponseStatusException;

import com.eventia.demo.dto.publico.PublicoDTO;
import com.eventia.demo.dto.publico.PublicoInsertDTO;
import com.eventia.demo.entidades.Publico;
import com.eventia.demo.entidades.Usuario;
import com.eventia.demo.repositories.PublicoRepository;
import com.eventia.demo.repositories.UsuarioRepository;

@Service
public class PublicoService {

	private final PublicoRepository repository;
	private final UsuarioRepository usuarioRepo;

	public PublicoService(PublicoRepository repository, UsuarioRepository usuarioRepo) {
		this.repository = repository;
		this.usuarioRepo = usuarioRepo;
	}

	public List<Publico> obtenerTodos() {
		return repository.findAll();
	}

	public Publico obtenerPorId(int id) {
		return repository.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND));
	}

	public Publico crear(PublicoInsertDTO dto) {
		Usuario user = usuarioRepo.findById(dto.getId_usuario())
				.orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND));
		Publico a = new Publico();
		a.setUsuario(user);
		a.setComunidadAutonoma(dto.getComunidad_autonoma());
		a.setProvincia(dto.getProvincia());
		a.setLocalidad(dto.getLocalidad());
		a.setGustosMusicales(dto.getGustos_musicales().name());
		a.setTipoEventosFavoritos(dto.getTipo_eventos_favoritos().name());
		a.setNotificaciones(dto.isNotificaciones());
		return repository.save(a);
	}

	public Publico modificar(int id, PublicoDTO dto) {
		Publico a = obtenerPorId(id);
		a.setComunidadAutonoma(dto.getComunidad_autonoma());
		a.setProvincia(dto.getProvincia());
		a.setLocalidad(dto.getLocalidad());
		a.setGustosMusicales(dto.getGustos_musicales().name());
		a.setTipoEventosFavoritos(dto.getTipo_eventos_favoritos().name());
		a.setNotificaciones(dto.isNotificaciones());
		return repository.save(a);
	}

	public void eliminar(int id) {
		if (!repository.existsById(id))
			throw new ResponseStatusException(HttpStatus.NOT_FOUND);
		repository.deleteById(id);
	}
}
