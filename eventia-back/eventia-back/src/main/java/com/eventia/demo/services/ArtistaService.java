package com.eventia.demo.services;

import java.util.List;

import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.server.ResponseStatusException;

import com.eventia.demo.dto.artistas.ArtistaInsertDTO;
import com.eventia.demo.dto.artistas.ArtistaUpdateDTO;
import com.eventia.demo.entidades.Artista;
import com.eventia.demo.entidades.Usuario;
import com.eventia.demo.repositories.ArtistaRepository;
import com.eventia.demo.repositories.UsuarioRepository;

@Service
public class ArtistaService {

	
	private final ArtistaRepository repository;
    private final UsuarioRepository usuarioRepo;

    public ArtistaService(ArtistaRepository repository, UsuarioRepository usuarioRepo) {
        this.repository = repository;
        this.usuarioRepo = usuarioRepo;
    }

    public List<Artista> obtenerTodos() { return repository.findAll(); }

    public Artista obtenerPorId(int id) {
        return repository.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND));
    }

    public Artista crear(ArtistaInsertDTO dto) {
        Usuario user = usuarioRepo.findById(dto.getId_usuario()).orElseThrow(() -> new RuntimeException("Usuario no encontrado"));
        Artista a = new Artista();
        a.setUsuario(user);
        a.setNombreArtistico(dto.getNombre_artistico());
        a.setTipo(dto.getTipo());
        a.setDescripcion(dto.getDescripcion());
        a.setPrecioReferencia(dto.getPrecio_referencia());
        a.setEquipoPropio(dto.isEquipo_propio());
        return repository.save(a);
    }

    public Artista modificar(int id, ArtistaUpdateDTO dto) {
        Artista a = obtenerPorId(id);
        a.setNombreArtistico(dto.getNombre_artistico());
        a.setTipo(dto.getTipo());
        a.setGeneroMusical(dto.getGenero_musical());
        a.setDescripcion(dto.getDescripcion());
        a.setPrecioReferencia(dto.getPrecio_referencia());
        a.setEquipoPropio(dto.getEquipo_propio());
        return repository.save(a);
    }

    public void eliminar(int id) {
        if (!repository.existsById(id)) throw new ResponseStatusException(HttpStatus.NOT_FOUND);
        repository.deleteById(id);
    }
}
